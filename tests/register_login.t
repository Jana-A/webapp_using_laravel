use strict;
use warnings;

use Test::More tests => 6;
use Test::WWW::Mechanize;

## ---------------------------------------------------
## Validate the ability to registr and login
## ---------------------------------------------------

## create a mechanize instance
my $mech = Test::WWW::Mechanize->new();

## navigate to the registration page
my $registration_url = 'http://localhost/blog/register';
$mech->get_ok($registration_url);
$mech->content_contains('Personal');

$mech->submit_form_ok({
	form_id  =>  'registration_form',
	fields   =>  {
		firstname   => 'test',
		occupation  => 'student',
		username    => 'test_user',
		password    => 'test_password',
		email       => 'test@email.com'
	},
});
$mech->content_contains('Login');


$mech->submit_form_ok({
	form_id => 'login_form',
	fields  => {
		login_username  => 'test_user',
		login_password  => 'test_password'
	}
});
$mech->content_contains('My Profile');
