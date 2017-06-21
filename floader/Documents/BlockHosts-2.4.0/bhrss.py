#!/usr/bin/env python
#bhrss.py

"""CGI script to provide a RSS feed of currently blocked and watched IP
addresses.

This script needs to be installed in the "cgi-bin" directory or similar,
under a Web server on the same machine that is running blockhosts.py.
Also requires that the default blockhosts configuration file be
available for reading values for hosts block file name, etc.

Replace the URL below with the correct path to bhrss.py on your web
server:
   http://.../cgi-bin/bhrss.py              [to get all blocked]
   http://.../cgi-bin/bhrss.py?q=watching   [to get all blocked as well as watched addresses]

The two variations both provide a RSS feed containing a list of IP
addresses, with count of failed attempts, and time when the entry was
added to the block file (/etc/hosts.allow). The first variation, with no
arguments, provides list of all addresses currently being blocked. The
second variation, with ?q=watching in the URI, lists all blocked
addresses, as well as the addresses that are currently being watched, but
not yet blocked.

====
bhrss.py Script License
This work is hereby released into the Public Domain.
To view a copy of the public domain dedication, visit
http://creativecommons.org/licenses/publicdomain/ or send a letter to
Creative Commons, 559 Nathan Abbott Way, Stanford, California 94305, USA.

Author: Avinash Chopde <avinash@acm.org>
Created: February 2007
http://www.aczoom.com/cms/blockhosts/

"""

# script metadata, also used by setup.py
SCRIPT_ID="bhrss"
VERSION="1.1.0"
VERSION_DATE="September 2007"
AUTHOR="Avinash Chopde"
AUTHOR_EMAIL="avinash@acm.org"
URL="http://www.aczoom.com/cms/blockhosts/"
LICENSE="http://creativecommons.org/licenses/publicdomain/"
DESCRIPTION="CGI script to provide RSS feed of blocked and watched hosts."
LONG_DESCRIPTION=DESCRIPTION

# -------------------------------------------------------------
import syslog
if __name__ == '__main__':
    syslog.openlog(SCRIPT_ID)

import cgi
#-------------------------------------
# for CGI debugging: import cgitb; cgitb.enable()
# import cgitb; cgitb.enable()
#-------------------------------------
import os
import sys
import traceback
import copy
import types
from time import localtime, gmtime, strftime, mktime, strptime, time as seconds

import xml.dom.minidom
import xml.dom.ext

import blockhosts
from blockhosts import die, Log, sort_by_value, Config, CommonConfig

# --------------------------------------
# CGI commands and values, for example ?q=blocked or ?q=watching
CGI_FIELD_Q = "q"
CGI_FIELD_VAL_BLOCKED = "blocked"
CGI_FIELD_VAL_WATCHING = "watching"

#######################################################################
class XMLElement:
    """XML element that contains zero or more sub-elements

    The dict "nodes" is used to store sub-elements name, value pairs - each
    such key will be converted to a <name>value</name> child element
    """
    def __init__(self, doc, name, parent, text =None):
        """Create element node and empty defaults for children nodes"""

        self.__doc = doc
        self.node = singleXMLElement(doc, name, parent)

        # for list of possible sub-elements in this XMLElement,
        # need ordered list of nodes, so can't use dict, use list to keep
        # order, and dict for fast access to sub-elements by name
        # XML Information Set, the core XML data model defined by the W3C,
        # characterizes element children as:
        #  An ordered list of child information items, in document order.
        #  ( http://www.w3.org/TR/xml-infoset/#infoitem.element )
        self.__nodes = {}
        self.__nodes_order = []

    def setChild(self, name, text = None):
        """Store data for child element <name>text</name>"""
        if not self.__nodes.has_key(name):
            self.__nodes_order.append(name)
        # create or update current value
        self.__nodes[name] = text

    def createChildrenXML(self):
        """Inserts all sub-elements, and clears the list of sub-elements"""
        for name in self.__nodes_order:
            singleXMLElement(self.__doc, name, self.node, self.__nodes[name])
        del self.__nodes_order[:]
        self.__nodes.clear()

##############
def singleXMLElement(doc, name, parent, text =None):
    """create XML element with optional text in it
    
    Helper function: creates a child element of given parent, and inserts
    an optional text node in the child element.
    """

    elem = doc.createElement(name)
    parent.appendChild(elem);
    if text:
        text_node = doc.createTextNode(text)
        elem.appendChild(text_node);
    return elem

#######################################################################
class RSS2:
    """RSS 2.0 data collector, and composer"""

    def __init__(self):
        """create RSS doc, with defaults"""

        self.doc = xml.dom.minidom.Document()

        self.rss_elem = singleXMLElement(self.doc, 'rss', self.doc)
        self.rss_elem.setAttribute('version', '2.0')

        self.channel = XMLElement(self.doc, 'channel', self.rss_elem)
        # defaults, to be changed by calling program, also sets order of
        # elements in output XML
        self.channel.setChild('title', 'Channel Title')
        self.channel.setChild('link', "http://link")
        self.channel.setChild('description', "Channel Description")
        self.channel.setChild('language', 'en-us')
        # self.channel.setChild('pubDate', "11 Nov 1999 11:11:11 GMT") # optional
        # self.channel.setChild('lastBuildDate', "11 Nov 1999 11:11:11 GMT") # optional
        # following defaults are probably ok, no change needed
        self.channel.setChild('generator', SCRIPT_ID + " " + VERSION)
        self.channel.setChild('docs', 'http://blogs.law.harvard.edu/tech/rss')

    def createItem(self):
        item = XMLElement(self.doc, 'item', self.channel.node)
        return item

#######################################################################
def getMyFullURI():
    # in future, use WSGI utilities from Python 2.5 or newer
    server_name = os.environ.get('SERVER_NAME', '')
    server_port = os.environ.get('SERVER_PORT', '80')
    request_uri = os.environ.get('REQUEST_URI', '')

    # standard port, no need to specify in URI
    if server_port == '80': server_port = ''
    else:                   server_port = ':' + server_port

    if server_name == '': server_port = '' # zero other parts also
    else:                 server_name = 'http://' + server_name

    my_uri = server_name + server_port + request_uri
    return my_uri

#######################################################################
def main(args=None):
    """Collects args, open block-file, deliver list of blocked addresses"""

    if args is None:
        args = sys.argv[1:]

    config = Config(args, VERSION, LONG_DESCRIPTION)
    config.add_section(CommonConfig())

    rest_args = config.parse_args()

    # set logging/message level in blockhosts as in this script
    Log.SetPrintLevel(config["verbose"])
    # Log.SetPrintLevel(0) # CGI, disable all messages?
    # Log.EnableSyslog(False)

    Log.Info("%s %s started: %s" % (SCRIPT_ID, VERSION, blockhosts.Config.START_TIME_STR))

    #-----------------------------------------------------------------
    # all options/args collected, construct output message

    # load all currently blocked hosts
    dh = blockhosts.BlockHosts(config["blockfile"], config["blockline"])
    try:
        dh.load_hosts_blockfile()
    except (blockhosts.MissingMarkerError, blockhosts.SecondMarkerError):
        die("Failed to load blockfile - block-file marker error\n Expected two marker lines in the file,\n somewhere in the middle of the file:\n%s\n%s\n" % (HOSTS_MARKER_LINE, HOSTS_MARKER_LINE))
    except:
        traceback.print_exc()
        die("Failed to load blockfile")

    (blocked_ips, watched_hosts) = dh.get_hosts_lists()

    form = cgi.FieldStorage()
    qvalue = form.getvalue(CGI_FIELD_Q, CGI_FIELD_VAL_BLOCKED)
    # qvalue = form.getvalue(CGI_FIELD_Q, CGI_FIELD_VAL_WATCHING) # DEBUG
    if not (qvalue == CGI_FIELD_VAL_BLOCKED or qvalue == CGI_FIELD_VAL_WATCHING):
        die("Invalid value for ?%s= (%s)" % (CGI_FIELD_Q, qvalue))

    rssobj = RSS2()

    # -- pubDate is last modified time of the blockfile (hosts.allow)
    blockfile_mtime = os.stat(config["blockfile"]).st_mtime
    blockfile_utctime = gmtime(blockfile_mtime)

    rss_time_format_utc = "%a, %d %b %Y %H:%M:%S +0000"
    rss_time = strftime(rss_time_format_utc, blockfile_utctime)
    rssobj.channel.setChild('pubDate', rss_time)
    rssobj.channel.setChild('lastBuildDate', rss_time)

    # -- link is the full URI of this script
    uri = getMyFullURI()
    if not uri:
        msg = "%s: could not determine page URI, so required RSS channel 'link' element will be left empty." % SCRIPT_ID
        Log.Error(msg)
        elem = rssobj.doc.createComment(msg)
        rssobj.channel.node.appendChild(elem);
    rssobj.channel.setChild('link', uri)

    # -- title and description
    if qvalue == CGI_FIELD_VAL_WATCHING:
        rssobj.channel.setChild('title', "Blocked Addresses and Watched Addresses")
        rssobj.channel.setChild('description', "All Currently Blocked Addresses, and List of Addresses Being Watched")
    else:
        rssobj.channel.setChild('title', "Blocked Addresses")
        rssobj.channel.setChild('description', "All Currently Blocked Addresses")

    # now that the channel text element nodes are filled in, create XML
    rssobj.channel.createChildrenXML()

    # create the <item> elements for the channel
    #
    # always include all blocked hosts in output
    # split the watched_hosts into two dicts - one containing all blocked
    # hosts with the data, and second containing all watched but not yet
    # blocked addresses
    hosts = sorted(blocked_ips)
    for host in hosts:
        item = rssobj.createItem()
        item.setChild('title', host)
        t = gmtime(blockhosts.Config.START_TIME)
        item.setChild('pubDate', strftime(rss_time_format_utc, t))
        item.createChildrenXML()

    # add watching-only (not yet blocked) addresses if asked for.
    if qvalue == CGI_FIELD_VAL_WATCHING:
        hosts = sort_by_value(watched_hosts, reverse = True)
        for host in hosts:
            item = rssobj.createItem()
            data = watched_hosts[host]
            item.setChild('title', host + " (Watching)")
            desc = "%15s <br />Count: %4d,  Updated At:  " % (host, data.count)
            t = localtime(data.time)
            item.setChild('description', "%15s <br />Count: %4d,  Updated At:  " % (host, data.count) + strftime(blockhosts.Config.ISO_STRFTIME, t))
            t = gmtime(data.time)
            item.setChild('pubDate', strftime(rss_time_format_utc, t))
            item.createChildrenXML()

    #print "Content-Type: application/rss+xml"     # RSS is following
    #mozilla does not like application/rss+xml
    print "Content-Type: text/xml"      # XML - RSS is following
    print                               # blank line, end of headers

    xml.dom.ext.PrettyPrint(rssobj.doc, sys.stdout) 
    # specify sys.stdout to allow unittests to work, without this, goes
    # to screen, but some other stdout object is used.

    Log.Debug("bhrss: all done.")

#######################################################################
if __name__ == '__main__':
    main()
