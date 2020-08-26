using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

using System.Data.SqlClient;
using System.Configuration;
using System.Data;

namespace WebApplication1.Classes
{

    public class MyBaseClass
    {
        protected string CS = ConfigurationManager.ConnectionStrings["CSDB"].ConnectionString;
        public SqlConnection Con { get; set; }

        public SqlCommand CommandBuilder(string query)
        {
            Con = new SqlConnection(CS);
            SqlCommand cmd = new SqlCommand(query, Con);
            Con.Open();

            return cmd;
        }

        public SqlDataReader ExecuteDataRdr(string query)
        {
            SqlCommand cmd = CommandBuilder(query);
            SqlDataReader rdr = cmd.ExecuteReader();

            return rdr;
        }

        public DataSet ExecuteDataSet(string query)
        {
            SqlCommand cmd = CommandBuilder(query);
            SqlDataAdapter da = new SqlDataAdapter(cmd);
            DataSet ds = new DataSet();
            da.Fill(ds);
            return ds;
        }

    }
}