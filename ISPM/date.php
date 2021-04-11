<?php

//string vchdate = Request.Form["vchdate"];
//string time = DateTime.Now.ToString("hh:mm:ss");
//string vchdateValue = vchdate.Value.ToString();

string fromdateValue = fromdate.Value.ToString();
string todateValue = todate.Value.ToString();
int warehouse_id = Convert.ToInt32(DropDownList11.SelectedValue);

DateTime fromdateValue101 = Convert.ToDateTime(fromdateValue);
DateTime todateValue101 = Convert.ToDateTime(todateValue);

//string fromdateValue102 = fromdateValue101.ToString("yyyy-MM-dd HH:mm:ss");
//string todateValue102 = todateValue101.ToString("yyyy-MM-dd HH:mm:ss");

int daycount101 = (int)(todateValue101 - fromdateValue101).TotalDays;