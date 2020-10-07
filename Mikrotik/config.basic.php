<?php

## Reset Configuration
	=> /system reset-configuration

## User Configuration
	=> user print; user add name = username group = full; set 1 password = 123123;

## Basic Configuration
Interface => IP.Address => IP.DNS => IP.Firewall.NAT => IP.Route

#Step-1 
Interface => [ 'Wan_Ether-1','Lan-Ether-2'];

#Step-2 
IP => Address List => Address => [
	'Wan_Ether-1' => '192.168.1.100/24',
	'Lan-Ether-2' => '20.20.20.1.1/24'
];

# Step-3 
IP =>DNS => [
	'Google DNS' => ['8.8.8.8','4.2.2.2'], // OR
	'ISP Gateway' => ['192.168.1.1']
];

# Step-4
IP => Firewall => NAT => [
	'Src Address' => '20.20.20.0/24', // OR
	'Out Interface' => 'Select Lan Interface'
];

# Step-5
IP => Route => [
	'Gateway' => '192.168.1.1' // ISP Gateway
];