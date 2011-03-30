#!/usr/bin/perl
print "Content-type: text/xml\n\n";

use LWP::Simple;
binmode( STDIN,  ':utf8' );
binmode( STDOUT, ':utf8' );
my $url = $ENV{'QUERY_STRING'};
my $content = get $url;
print $content; 

