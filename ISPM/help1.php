<?php

use ispm;

//Select======
SqlConnection con = new SqlConnection(CS);
string query = @"select top 1 row_number() over (order by id) as row_number, id, name, code,username, 
serverip, password, remarks, port,
(case status when 0 then 'Inactive' else 'Active' end) as status,
convert(varchar(11),created_at,106) as created_at from ispnetworks where branch_id = '" + branch_id + "' order by id asc";
SqlCommand cmd = new SqlCommand(query, con);
con.Open();

SqlDataReader rdr = cmd.ExecuteReader();
Credential credential = new Credential();
while (rdr.Read())
{
    credential.tikConnectionType = TikConnectionType.Api;
    credential.name = rdr["name"].ToString();
    credential.code = rdr["code"].ToString();
    credential.host = rdr["serverip"].ToString();
    credential.port = Convert.ToInt32(rdr["port"].ToString());
    credential.username = rdr["username"].ToString();
    credential.password = rdr["password"].ToString();
    
}
con.Close();
return credential;
//Select======



 <%--Profit & Loss Values--%>

                        <p class="text-danger">
                            <span>Opening Stock :  </span>
                            <span>
                                
                            </span>

                            <span>| purchase :  </span>
                            <span>
                                
                            </span>

                            <span>| dexpense :  </span>
                            <span>
                                
                            </span>

                            <span>| Closing Stock :  </span>
                            <span>
                                
                            </span>

                            <span>| sale :  </span>
                            <span>
                                <%--<asp:Label ID="Label5" runat="server" Text=""></asp:Label>--%>
                            </span>

                            <span>| dincome :  </span>
                            <span>
                                <%--<asp:Label ID="Label6" runat="server" Text=""></asp:Label>--%>
                            </span>

                            <span>| grosslossco :  </span>
                            <span>
                                <%--<asp:Label ID="Label7" runat="server" Text=""></asp:Label>--%>
                            </span>

                            <span>| grosslossco :  </span>
                            <span>
                                <%--<asp:Label ID="Label8" runat="server" Text=""></asp:Label>--%>
                            </span>

                            <span>| indexpense :  </span>
                            <span>
                                <%--<asp:Label ID="Label9" runat="server" Text=""></asp:Label>--%>
                            </span>

                            <span>| indincome :  </span>
                            <span>
                                <%--<asp:Label ID="Label10" runat="server" Text=""></asp:Label>--%>
                            </span>

                            <span>| Net Profit :  </span>
                            <span>
                                <%--<asp:Label ID="Label11" runat="server" Text=""></asp:Label>--%>
                            </span>

                            <span>| Total Expense :  </span>
                            <span>
                                <%--<asp:Label ID="Label12" runat="server" Text=""></asp:Label>--%>
                            </span>

                            <span>| Total Income:  </span>
                            <span>
                                <%--<asp:Label ID="Label13" runat="server" Text=""></asp:Label>--%>
                            </span>

                            <span>| Liabilities :  </span>
                            <span>
                                <asp:Label ID="Label14" runat="server" Text=""></asp:Label>
                            </span>

                            <span>| Asset:  </span>
                            <span>
                                <asp:Label ID="Label15" runat="server" Text=""></asp:Label>
                            </span>


                            <span>| Total Liabilities:  </span>
                            <span>
                                <asp:Label ID="Label16" runat="server" Text=""></asp:Label>
                            </span>

                            <span>| Total Asset:  </span>
                            <span>
                                <asp:Label ID="Label17" runat="server" Text=""></asp:Label>
                            </span>

                        </p>


                        <%--Profit & Loss Values--%>
