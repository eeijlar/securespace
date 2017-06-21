#!/usr/bin/perl 
use strict;
use JavaScript::Minifier qw(minify);

my $out_path = "js2/";

my @files = </home/floader/Documents/js/fckeditor/*.js>;
 foreach my $file (@files) {
   print $file . "\n";
  if ( -f $file) {
  open(INFILE, $file) or die;
  my $filename = $file;
  my $dirname = $filename; 
  $dirname =~ s!^(.*/)[^/]*$!\1!;
  $filename =~ s!^.*/([^/]*)$!\1!;

  my $min = $out_path.$filename;
   print $min . "\n";
  open(OUTFILE, ">",$min) or die;
  minify(input => *INFILE, outfile => *OUTFILE);
  close(INFILE);
  close(OUTFILE);
 }
 }
