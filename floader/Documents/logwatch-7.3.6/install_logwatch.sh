#!/bin/sh
#
#The MIT License
#
#Copyright (c) 2005-2006 Mike Tremaine <mgt /at/ stellarcore.net> 
#
#Permission is hereby granted, free of charge, to any person obtaining 
#a copy of this software and associated documentation files (the "Software"),
#to deal in the Software without restriction, including without limitation
#the rights to use, copy, modify, merge, publish, distribute, sublicense,
#and/or sell copies of the Software, and to permit persons to whom the
#Software is furnished to do so, subject to the following conditions:
#
#The above copyright notice and this permission notice shall be included
#in all copies or substantial portions of the Software.
#
#THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
#EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
#MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
#IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
#DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
#OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR
#THE USE OR OTHER DEALINGS IN THE SOFTWARE.
# __________________________________________________________________
#
# File: install_logwatch.sh 
# Author: Mike Tremaine [mgt /at/ stellarcore.net]
# Maintainer:
# Version: 1.0.1
#
# __________________________________________________________________
#
#Note: This script is provided for the non-RPM installs.
#It is preferred that logwatch be packaged by a distribution
#specifically for your installation. But since that is not always
#possible we have included this script.

#Add PATHS for various OS options
#Set PATH for solaris /usr/ucb/install
PATH=/usr/ucb:$PATH
#Set PATH for OpenBSD makewhatis /usr/libexec/makewhatis
PATH=$PATH:/usr/libexec
#Set PATH for IRIX makewhatis /usr/lib/makewhatis
PATH=$PATH:/usr/lib
export PATH

#Set OS and GLOBIGNORE
OS=`uname -s`
GLOBIGNORE=*CVS

#All these can be set via user input
#Defaults
BASEDIR="/usr/share/logwatch"
CONFIGDIR="/etc/logwatch"
TEMPDIR="/var/cache/logwatch"
PERLEXE="/usr/bin/perl"
MANDIR="/usr/share/man"


#Talk to user
printf "#################################\n"
printf "Preparing to install Logwatch\n"
printf "Enter the path to the Logwatch BaseDir [$BASEDIR] : "
read base

if [ "$base" = "" ]; then
   printf "### Using $BASEDIR\n"
else
   BASEDIR="$base"
   #Set munge flag
   munge_base=1
   printf "### Using $BASEDIR [will modify logwatch.pl]\n"
fi

printf "Enter the path for the Logwatch ConfigDir [$CONFIGDIR] : "
read config  

if [ "$config" = "" ]; then
   printf "### Using $CONFIGDIR\n"
else
   CONFIGDIR="$config" 
   munge_conf=1
   printf "### Using $CONFIGDIR [will modify logwatch.pl]\n"
fi

printf "Enter the dir name to be used for temp files [$TEMPDIR] : "
read temp

if [ "$temp" = "" ]; then
   printf "### Using $TEMPDIR\n"
else
   TEMPDIR="$temp"
   munge_temp=1
   printf "### Using $TEMPDIR [will write to $CONFIGDIR/conf/logwatch.conf]\n"
fi

printf "Enter the location of perl [$PERLEXE] : "
read perlexe

if [ "$perlexe" = "" ]; then
   printf "### Using $PERLEXE\n"
else
   PERLEXE="$perlexe"
   munge_perl=1
   printf "### Using $PERLEXE [will modify logwatch.pl]\n"
fi

printf "Enter the dir name to used for the manpage [$MANDIR] : "
read mandir

if [ "$mandir" = "" ]; then
   printf "### Using $MANDIR\n"
else
   MANDIR="$mandir"
   printf "### Using $MANDIR [Will try to run makewhatis]\n"
fi

echo "### Installing"

#OS Tests for known issues
if [ $OS = "Darwin" ]; then
   munge_gzcat = 1
fi

#Install is borked under IRIX
#BASE
install -m 0755 -d $BASEDIR
install -m 0755 -d $BASEDIR/dist.conf
install -m 0755 -d $BASEDIR/dist.conf/logfiles
install -m 0755 -d $BASEDIR/dist.conf/services
install -m 0755 -d $BASEDIR/default.conf
install -m 0755 -d $BASEDIR/default.conf/logfiles
install -m 0755 -d $BASEDIR/default.conf/services
install -m 0755 -d $BASEDIR/default.conf/html
install -m 0755 -d $BASEDIR/scripts
install -m 0755 -d $BASEDIR/scripts/logfiles
install -m 0755 -d $BASEDIR/scripts/services
install -m 0755 -d $BASEDIR/scripts/shared
install -m 0755 -d $BASEDIR/lib
install -m 0644 README $BASEDIR/README
install -m 0644 HOWTO-Customize-LogWatch $BASEDIR/HOWTO-Customize-LogWatch
install -m 0644 conf/*.conf $BASEDIR/default.conf
install -m 0644 conf/logfiles/* $BASEDIR/default.conf/logfiles
install -m 0644 conf/services/* $BASEDIR/default.conf/services
install -m 0644 conf/html/* $BASEDIR/default.conf/html
install -m 0755 scripts/logwatch.pl $BASEDIR/scripts/logwatch.pl
for i in scripts/logfiles/* ; do
   if [ `ls $i | grep -v CVS | wc -l` -ne 0 ] ; then
      install -m 0755 -d $BASEDIR/$i
      install -m 0644 $i/* $BASEDIR/$i
   fi
done
install -m 0644 scripts/shared/* $BASEDIR/scripts/shared
install -m 0644 scripts/services/* $BASEDIR/scripts/services
install -m 0644 lib/* $BASEDIR/lib

if [ $munge_base ]; then
   perl -pi -e "s%/usr/share/logwatch%$BASEDIR%" $BASEDIR/scripts/logwatch.pl
fi

#CONFIG
install -m 0755 -d $CONFIGDIR
install -m 0755 -d $CONFIGDIR/scripts
install -m 0755 -d $CONFIGDIR/scripts/services
install -m 0755 -d $CONFIGDIR/conf
install -m 0755 -d $CONFIGDIR/conf/logfiles
install -m 0755 -d $CONFIGDIR/conf/services
install -m 0755 -d $CONFIGDIR/conf/html

if [ $munge_conf ]; then
   perl -pi -e "s%/etc/logwatch/conf%$CONFIGDIR/conf%" $BASEDIR/scripts/logwatch.pl
fi

touch $CONFIGDIR/conf/logwatch.conf
touch $CONFIGDIR/conf/ignore.conf
touch $CONFIGDIR/conf/override.conf

#TEMP
#Using sanity check incase someone uses /tmp.
#The install would destory the perms on /tmp
if [ ! -d $TEMPDIR ]; then
   #Should this be 0700 -d $TEMPDIR ??
   install -m 0755 -d $TEMPDIR
fi

#This can create duplicates need to grep first -mgt
if [ $munge_temp ]; then
   echo "TmpDir = $TEMPDIR" >> $CONFIGDIR/conf/logwatch.conf
fi

#PERL
if [ $munge_perl ]; then
   perl -pi -e "s%/usr/bin/perl%$PERLEXE%" $BASEDIR/scripts/logwatch.pl
fi

#Gzcat
if [ $munge_gzcat ]; then
   echo "Pathtozcat = gzcat" >> $CONFIGDIR/conf/logwatch.conf
fi

#Search for makewhatis
for f in `echo $PATH | tr : ' '`; do
   if [ -x "$f/makewhatis" ]; then
      HAVE_MAKEWHATIS=1;
   fi;
done

#Man page
if [ -d $MANDIR/man8 ] && [ $HAVE_MAKEWHATIS ]; then
   install -m 0644 logwatch.8 $MANDIR/man8
   #OpenBSD no -s
   if [ $OS = "OpenBSD" ]; then
      makewhatis -u $MANDIR/man8
   else
      #FreeBSD and NetBSD no -s no -u
      if [ $OS = "FreeBSD" ] || [ $OS = "NetBSD" ]; then
         makewhatis $MANDIR/man8
      else
         #MacOS X aka Darwin no -u [even thought the manpage says]
         if [ $OS = "Darwin" ]; then
            makewhatis -s 8 $MANDIR
         else
         #Linux
            makewhatis -u -s 8 $MANDIR
         fi
      fi
   fi
else
   if [ $OS = "SunOS" ]; then
      #Go for the safe install rather then editing man.cf
      install -m 0644 logwatch.8 $MANDIR/man1m
      catman -w -M /usr/share/man/man1m
   else
      install -m 0755 -d $MANDIR/man8
      install -m 0644 logwatch.8 $MANDIR/man8
      printf "Installed manpage in $MANDIR/man8.\n"
      printf "Check your man.cf or man.conf to enable MANSECTS 8\n"
   fi
fi

#Symlink
ln -f -s $BASEDIR/scripts/logwatch.pl /usr/sbin/logwatch
printf "Created symlink for /usr/sbin/logwatch \n"

#Cron
if [ -d /etc/cron.daily ]; then
   rm -f /etc/cron.daily/0logwatch
   ln -s $BASEDIR/scripts/logwatch.pl /etc/cron.daily/0logwatch
   printf "Created /etc/cron.daily/0logwatch \n" 
else
   printf "You need to setup your cron job for logwatch, something like \n"
   printf "2 0 * * * $BASEDIR/scripts/logwatch.pl >/dev/null 2>&1 \n"
fi

exit
# vi: shiftwidth=3 tabstop=3 et
