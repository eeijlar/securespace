#!/usr/bin/perl 

use strict;
use DBI;

# Author: John Lawlor

my $host = "localhost";
my $user = "php-bin";
my $pwd = "rEnMeWUMxAKRM5pE";
my $port = "3306";
my $sth;
my $dbh;
my @resultSet;
my $dbname = "dbi:mysql:HOST=$host;SID=$user\@$host;PORT=$port";
print "Database connection string: $dbname\n";

sub query(){

	my ($sql)= @_;	
	my $index = 0;
	
	$sth = $dbh->prepare($sql) or die "Couldn't prepare statement: " . $dbh->errstr;	
					
	$sth->execute() or die "Couldn't execute statement: " . $sth->errstr;
	
	while (my @rowData = $sth->fetchrow_array) {
		@resultSet[$index] = @rowData[0];
		#print @resultSet[$index]."\n";
		$index++;
	}

return $index;
}

sub insert() {

	my ($sql)= @_;		
	
	$sth = $dbh->prepare($sql) or die "Couldn't prepare statement: " . $dbh->errstr;	
					
	$sth->execute() or die "Couldn't execute statement: " . $sth->errstr;
	print "1 row inserted\n";

	
}

sub create() {

    my $sql = "CREATE TABLE %s (";		
	
	$sth = $dbh->prepare($sql) or die "Couldn't prepare statement: " . $dbh->errstr;	
					
	$sth->execute() or die "Couldn't execute statement: " . $sth->errstr;
	print "1 row inserted\n";

	
}

sub update() {

   	my ($sql) = @_;
	$sth = $dbh->prepare($sql) or die "Couldn't prepare statement: " . $dbh->errstr;	
	$sth->execute() or die "Couldn't execute statement: " . $sth->errstr;
        if ($sth->rows > 0) {
                 print "Query OK," . $sth->rows . "row affected";
        }
}

sub drop(){

	my ($table)= @_;		
	
	my $sql = sprintf("DROP TABLE %s CASCADE CONSTRAINTS",$table);
	
	$sth = $dbh->prepare($sql) or die "Couldn't prepare statement: " . $dbh->errstr;	
					
	$sth->execute() or die "Couldn't execute statement: " . $sth->errstr;
	print "Table dropped\n";


}

sub openDbConnection() {
	$dbh = DBI->connect ($dbname, $user ,$pwd , { RaiseError => 1}) || die "Database connection not made: $DBI::errstr";
        print "Db connection open, to: $user\@$host\n";
}

sub closeDbConnection() {
	#$sth->finish();
	$dbh->disconnect();
        print "Db connection closed\n";
}




openDbConnection();
print "Selecting database...\n";
&update("use SS_DATA");
my $result = &query("select * from messages where ts_created < (CURDATE() - INTERVAL 14 DAY) and message_status = 'Read'");
print "$result message(s) were returned from the database\n";

foreach my $message_id (@resultSet) {
   print "Removing message with id: $message_id\n";
   &update("delete from messages where message_id = $message_id");
   &update("delete from messages_profile where message_id = $message_id");
}

for (@resultSet) { $_ = undef };
$result = &query("select * from messages where ts_created < (CURDATE() - INTERVAL 60 DAY)");
print "$result message(s) were returned from the database\n";
foreach my $message_id (@resultSet) {
   print "Removing message with id: $message_id\n";
   &update("delete from messages where message_id = $message_id");
   &update("delete from messages_profile where message_id = $message_id");
}



closeDbConnection();
