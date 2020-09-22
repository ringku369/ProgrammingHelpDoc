
//Router Configuration Sequence
 # interface => address => dns => firewall => route 


// wan network confifure by cmd cli

[admin@MikroTik] > interface set numbers=0 name=Wan comment=WanInterface
[admin@MikroTik] > interface set numbers=1 name=Lan comment=LanInterface

[admin@MikroTik] > ip address add address=192.168.0.110/24 interface=Wan disabled=no comment=WAN-IP                
[admin@MikroTik] > ip address add address=172.16.10.1/24 interface=Lan disabled=no comment=LAN-IP    

[admin@MikroTik] > ip route add gateway=192.168.0.1 comment=Gateway-IP

[admin@MikroTik] > ip dns set servers=192.168.0.1 allow-remote-requests=yes cache-size=10000KiB

[admin@MikroTik] > ip firewall nat add chain=srcnat out-interface=Wan action=masquerade                      

// ppoe configure by cmd cli

[admin@MikroTik] > ip pool add name=pppoe-pool ranges=10.10.10.100-10.10.10.200      

[admin@MikroTik] > ppp profile add name=pppoe-profile-1M local-address=10.10.10.1 remote-address=pppoe-pool dns-ser
ver=10.10.10.1 rate-limit=1M/1M

[admin@MikroTik] > interface pppoe-server server add service-name=pppoe-service-1M interface=Lan one-session-per-ho
st=yes max-sessions=0 default-profile=pppoe-profile-1M authentication=pap disabled=no                

[admin@MikroTik] > ppp secret add name=ringku369@yahoo.com password=123123 profile=pppoe-profile-1M 
[admin@MikroTik] > ppp secret add name=ringku369@gmail.com password=123123 profile=pppoe-profile-1M