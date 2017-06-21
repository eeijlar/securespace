#!/usr/bin/perl

use Mail::Sendmail qw(sendmail %mailcfg);

$mail{smtp} = 'mail.alma.ch';
my $mailRecipient = "jk.lawlor\@gmail.com";
my $mailSubject = "Report";
my $fromAddress = "jk.lawlor\@gmail.com";


open (LOG,">>logfile.txt");
my $messageBody = do { local $/; <LOG> };
close(LOG);
my %mail = ( To      => $mailRecipient,
             From    => $fromAddress,
             Subject => $mailSubject,
             Message => $messageBody);

sendmail(%mail) or die $Mail::Sendmail::error;

print "OK. Log says:\n\n\n", $Mail::Sendmail::log;
