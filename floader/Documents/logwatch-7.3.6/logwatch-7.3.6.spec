Summary: Analyzes and Reports on system logs
Name: logwatch
Version: 7.3.6
Release: 1
Vendor: Kirk Bauer <kirk@kaybee.org>
License: MIT
Group: Utilities/System
URL: http://www.logwatch.org
BuildArch: noarch
Source: ftp://ftp.kaybee.org/pub/linux/logwatch-7.3.6.tar.gz
Requires: perl,textutils,sh-utils,grep,mailx
BuildRoot: %{_tmppath}/logwatch-build/

%description
Logwatch is a customizable, pluggable log-monitoring system.  It will go
through your logs for a given period of time and make a report in the areas
that you wish with the detail that you wish.  Easy to use - works right out
of the package on many systems.


%prep
rm -rf %{buildroot}
%setup

%build


%install
install -m 0755 -d %{buildroot}%{_var}/cache/logwatch
install -m 0755 -d %{buildroot}%{_sysconfdir}/logwatch/scripts
install -m 0755 -d %{buildroot}%{_sysconfdir}/logwatch/scripts/services
install -m 0755 -d %{buildroot}%{_sysconfdir}/logwatch/conf
install -m 0755 -d %{buildroot}%{_sysconfdir}/logwatch/conf/logfiles
install -m 0755 -d %{buildroot}%{_sysconfdir}/logwatch/conf/services
install -m 0755 -d %{buildroot}%{_datadir}/logwatch/default.conf/logfiles
install -m 0755 -d %{buildroot}%{_datadir}/logwatch/default.conf/services
install -m 0755 -d %{buildroot}%{_datadir}/logwatch/default.conf/html
install -m 0755 -d %{buildroot}%{_datadir}/logwatch/dist.conf/logfiles
install -m 0755 -d %{buildroot}%{_datadir}/logwatch/dist.conf/services
install -m 0755 -d %{buildroot}%{_datadir}/logwatch/scripts/services
install -m 0755 -d %{buildroot}%{_datadir}/logwatch/scripts/shared
install -m 0755 -d %{buildroot}%{_datadir}/logwatch/lib

install -m 0755 scripts/logwatch.pl %{buildroot}%{_datadir}/logwatch/scripts/logwatch.pl
for i in scripts/logfiles/* ; do
   if [ $(ls $i | wc -l) -ne 0 ] ; then
      install -m 0755 -d %{buildroot}%{_datadir}/logwatch/$i
      install -m 0755 $i/* %{buildroot}%{_datadir}/logwatch/$i
   fi
done
install -m 0755 scripts/services/* %{buildroot}%{_datadir}/logwatch/scripts/services
install -m 0755 scripts/shared/* %{buildroot}%{_datadir}/logwatch/scripts/shared
install -m 0755 lib/* %{buildroot}%{_datadir}/logwatch/lib

install -m 0644 conf/*.conf %{buildroot}%{_datadir}/logwatch/default.conf
install -m 0644 conf/logfiles/* %{buildroot}%{_datadir}/logwatch/default.conf/logfiles
install -m 0644 conf/services/* %{buildroot}%{_datadir}/logwatch/default.conf/services
install -m 0644 conf/html/* %{buildroot}%{_datadir}/logwatch/default.conf/html

install -m 0755 -d %{buildroot}%{_mandir}/man8
install -m 0644 logwatch.8 %{buildroot}%{_mandir}/man8

rm -f   %{buildroot}%{_sysconfdir}/cron.daily/logwatch \
   %{buildroot}%{_sbindir}/logwatch

install -m 0755 -d %{buildroot}%{_sysconfdir}/cron.daily
ln -s %{_datadir}/logwatch/scripts/logwatch.pl %{buildroot}%{_sysconfdir}/cron.daily/0logwatch
install -m 0755 -d %{buildroot}%{_sbindir}
ln -s %{_datadir}/logwatch/scripts/logwatch.pl %{buildroot}%{_sbindir}/logwatch

echo "###### REGULAR EXPRESSIONS IN THIS FILE WILL BE TRIMMED FROM REPORT OUTPUT #####" > %{buildroot}%{_sysconfdir}/logwatch/conf/ignore.conf
echo "# Local configuration options go here (defaults are in %{_datadir}/logwatch/default.conf/logwatch.conf)" > %{buildroot}%{_sysconfdir}/logwatch/conf/logwatch.conf
echo "# Configuration overrides for specific logfiles/services may be placed here." > %{buildroot}%{_sysconfdir}/logwatch/conf/override.conf


%clean
rm -rf %{buildroot}

%post


%pre


%preun


%postun


%files
%defattr(-,root,root)
%doc README HOWTO-Customize-LogWatch
%dir %{_var}/cache/logwatch
%dir %{_sysconfdir}/logwatch
%dir %{_sysconfdir}/logwatch/scripts
%dir %{_sysconfdir}/logwatch/scripts/services
%dir %{_sysconfdir}/logwatch/conf
%dir %{_sysconfdir}/logwatch/conf/logfiles
%dir %{_sysconfdir}/logwatch/conf/services
%dir %{_datadir}/logwatch
%dir %{_datadir}/logwatch/default.conf
%dir %{_datadir}/logwatch/default.conf/services
%dir %{_datadir}/logwatch/default.conf/logfiles
%dir %{_datadir}/logwatch/default.conf/html
%dir %{_datadir}/logwatch/dist.conf
%dir %{_datadir}/logwatch/dist.conf/services
%dir %{_datadir}/logwatch/dist.conf/logfiles
%dir %{_datadir}/logwatch/scripts
%dir %{_datadir}/logwatch/scripts/logfiles
%dir %{_datadir}/logwatch/scripts/services
%dir %{_datadir}/logwatch/scripts/shared
%dir %{_datadir}/logwatch/scripts/logfiles/*
%dir %{_datadir}/logwatch/lib
%{_datadir}/logwatch/scripts/logwatch.pl
%{_sbindir}/logwatch
%{_datadir}/logwatch/scripts/shared/*
%{_datadir}/logwatch/scripts/services/*
%{_datadir}/logwatch/scripts/logfiles/*/*
%{_datadir}/logwatch/lib/Logwatch.pm
%{_datadir}/logwatch/default.conf/*.conf
%{_datadir}/logwatch/default.conf/services/*.conf
%{_datadir}/logwatch/default.conf/logfiles/*.conf
%{_datadir}/logwatch/default.conf/html/*.html
%{_sysconfdir}/cron.daily/0logwatch
%doc %{_mandir}/man8/logwatch.8*
%config(noreplace) %{_sysconfdir}/logwatch/conf/*.conf

%doc License project/CHANGES project/TODO

%changelog
* Fri Sep 15 2006 Kirk Bauer <kirk@kaybee.org> 7.3.1-1
- Fixed install script to create empty scripts directory in /etc

* Sat Oct 08 2005 Kirk Bauer <kirk@kaybee.org> pre7.0-1
- Numerous changes, most notably a whole new directory structure.

* Thu Feb 24 2005 Kirk Bauer <kirk@kaybee.org> 6.0.1-1
- Now includes ignore.conf in the RPM

* Mon Nov 03 2003 Kirk Bauer <kirk@kaybee.org> pre5.0-1
- Now can build without change as non-root user

* Thu Feb 27 2003 Erik Ogan <erik@ogan.net> 4.3.2
- Added libdir & lib/Logwatch.pm
	
* Sun Oct 13 2002 Kirk Bauer <kirk@kaybee.org> pre4.0-14
- Changed the 'logwatch' cron.daily job to '0logwatch' to run before logrotate

* Thu Oct 10 2002 Kirk Bauer <kirk@kaybee.org> pre4.0-1
- Cronjob is now just named logwatch and not 00-logwatch

* Wed May 01 2002 Kirk Bauer <kirk@kaybee.org> 3.0-6
- up2date packaged... finally!

* Wed May 01 2002 Kirk Bauer <kirk@kaybee.org> 3.0-5
- Hopefully now properly included the up2date filter!

* Mon Apr 29 2002 Kirk Bauer <kirk@kaybee.org> pre3.0-1
- Now properly includes logfile-specific scripts

* Tue Apr 09 2002 Kirk Bauer <kirk@kaybee.org> 2.8-2
- Made man page entry in files list backwards compatible

* Thu Mar 28 2002 Kirk Bauer <kirk@kaybee.org> 2.5-2
- Updated new changes from Red Hat's rawhide packaging

* Wed Nov 18 1998 Kirk Bauer <kirk@kaybee.org>
- Modified to comply with RHCN standards

* Sun Feb 23 1998 Kirk Bauer <kirk@kaybee.org>
- Minor changes and addition of man-page

* Sun Feb 22 1998 Kirk Bauer <kirk@kaybee.org>
- initial release

