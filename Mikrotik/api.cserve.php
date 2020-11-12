<?php

// Mikrotik API Link 
# https://forum.mikrotik.com/viewtopic.php?t=99954


## Connection Common Code

Credential credential = IspCredentialRepository.GetIspCredentialById(ispnetwork_id);

ITikConnection connection = ConnectionFactory.OpenConnection(
    credential.tikConnectionType, credential.host, credential.port, credential.username, credential.password);

## Print Command For List Of Row

var command = connection.CreateCommandAndParameters("/ppp/secret/print");
var results = command.ExecuteList();

foreach (var item in results)
{
	//id = *2 | name = user - 2@yahoo.com | service = pppoe | password = 123123 | profile = 8 - mb - profile | 
	//local - address = 0.0.0.0 | remote - address = 0.0.0.0 | limit - bytes -in= 0 | limit - bytes -out= 0 | last - logged -out= jan / 01 / 1970 00:00:00 | disabled = false

	//Response.Write("Total Items " + item + "<br />");
	//string email = item.GetResponseField("name");
	//string password = item.GetResponseField("password");

	string rusername = item.GetResponseField("name");
	string rpassword = item.GetResponseField("password");
	string rid = item.GetId();

	string profile = item.GetResponseField("profile");
	string service = item.GetResponseField("service");
	bool isRouterInactive = Convert.ToBoolean(item.GetResponseField("disabled"));
	string remoteAddress = item.GetResponseFieldOrDefault("remote-address", "0.0.0.0");

}


## Print Others Commands For Single Row

var loadCmd = connection.CreateCommandAndParameters("/ip/address/print", "address", "172.16.10.1/24");
var response = loadCmd.ExecuteList();
var itemId = response.Single().GetId();
var itemInterface = response.Single().GetResponseField("interface");
Response.Write(itemInterface);

## Print Commands For Log

var logs = connection.LoadList<Log>();
foreach (Log log in logs)
{
  Response.Write("Time " +  log.Time + "Topicks " + log.Topics + "Message " + log.Message + "<br />");
}



## Add Command
var createCommand = connection.CreateCommandAndParameters("/ppp/secret/add",
                                "name", rusername,
                                "password", rpassword, 
                                "service", service, 
                                "profile", profile);
string rid = createCommand.ExecuteScalar();

## Set Command
var updateCmd = connection.CreateCommandAndParameters("/ppp/secret/set",
               "profile", profile,
               TikSpecialProperties.Id, ViewState["rid"].ToString());
updateCmd.ExecuteNonQuery();

## Remove Command
var deleteCmd = connection.CreateCommandAndParameters("/ppp/secret/remove", TikSpecialProperties.Id, rid);
deleteCmd.ExecuteNonQuery();






## Details Command



Credential credential = IspCredentialRepository.GetIspCredentialById(ispnetwork_id);
try
{
    //router code======
    ITikConnection connection = ConnectionFactory.OpenConnection(
        credential.tikConnectionType, credential.host, credential.port, credential.username, credential.password);
    
    //add name = u24md@gmail.com password = 123123 service = pppoe profile = 4MB - Profile


    var createCommand = connection.CreateCommandAndParameters("/ppp/secret/add",
                                    "name", rusername,
                                    "password", rpassword, 
                                    "service", service, 
                                    "profile", profile);
    string rid = createCommand.ExecuteScalar();


    bool isRouterInactive = false;
    int isRouter = 1;
    

    insertrequest(ispnetwork_id, ispzone_id, ispsubzone_id, ispbox_id, ispmacuser_id, IsMainOrMac, isppackage_id,
    name, email, password, contact, address, rusername, rpassword, profile, service, isRouter, isRouterInactive, rid);
    
    GetPppoeClientData();


    success_area.Visible = true;
    error_area.Visible = false;
    success_msg.Text = "Successfully user created with mikrotik router";
}
catch (Exception ex)
{
    string rid = null;
    int isRouter = 0;
    bool isRouterInactive = true;

    insertrequest(ispnetwork_id, ispzone_id, ispsubzone_id, ispbox_id, ispmacuser_id, IsMainOrMac, isppackage_id,
       name, email, password, contact, address, rusername, rpassword, profile, service, isRouter, isRouterInactive, rid);
    
    GetPppoeClientData();


    success_area.Visible = true;
    error_area.Visible = false;
    success_msg.Text = "Successfully user created but not in mikrotik router";
}


try
{
    ITikConnection connection = ConnectionFactory.OpenConnection(
        credential.tikConnectionType, credential.host, credential.port, credential.username, credential.password);

    var command = connection.CreateCommandAndParameters("/interface/print");
    var results = command.ExecuteList();

    foreach (var item in results)
    {
        Response.Write("Address " + item.GetResponseField("name") + "<br />");

    }
}
catch (Exception exception)
{

    Response.Write("message : " + exception);
}
