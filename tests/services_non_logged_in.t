use strict;
use warnings;

use Test::More tests => 3;
use Test::WWW::Mechanize;

## ---------------------------------------------------
## Validate functionalities in the Services tab
## ---------------------------------------------------

## create a mechanize instance
my $mech = Test::WWW::Mechanize->new();

my $browse_services = 'http://localhost/blog/browse';
$mech->get_ok($browse_services);
$mech->content_contains('disabled">Add A Service <span');
$mech->follow_link(id => 'who_username');
$mech->content_contains('Login to view profiles!');
