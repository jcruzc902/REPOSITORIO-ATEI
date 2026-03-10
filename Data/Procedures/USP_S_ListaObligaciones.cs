using Dapper;
using Data.Connection;
using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Data.Procedures
{
    public class USP_S_ListaObligaciones
    {
        public int I_MatAluID { get; set; }

        public int I_ObligacionAluID { get; set; }

        public string C_CodAlu { get; set; }

        public string C_RcCod { get; set; }

        public string T_Nombre { get; set; }

        public string T_ApePaterno { get; set; }

        public string T_ApeMaterno { get; set; }

        public string N_Grado { get; set; }

        public string C_CodFac { get; set; }

        public string T_FacDesc { get; set; }

        public string C_CodEsc { get; set; }

        public string T_EscDesc { get; set; }

        public string T_DenomProg { get; set; }

        public bool B_Ingresante { get; set; }

        public int I_CredDesaprob { get; set; }

        public int I_Anio { get; set; }

        public int I_Periodo { get; set; }

        public string T_Periodo { get; set; }

        public string T_ProcesoDesc { get; set; }

        public decimal? I_MontoOblig { get; set; }

        public DateTime? D_FecVencto { get; set; }

        public bool? B_Pagado { get; set; }

        public decimal? I_MontoPagadoActual { get; set; }

        public DateTime? D_FecCre { get; set; }

        public DateTime? D_FecMod { get; set; }

        public string T_MontoPagos { get; set; }

        public string T_FecPagos { get; set; }

        public static IEnumerable<USP_S_ListaObligaciones> Execute(USP_S_ListadoEstadoObligaciones_Parameters pr)
        {
            IEnumerable<USP_S_ListaObligaciones> result;
            DynamicParameters parameters;
            string s_command;

            try
            {
                s_command = "USP_S_ListaObligaciones";

                parameters = new DynamicParameters();

                using (var _dbConnection = new SqlConnection(Database.ConnectionString))
                {
                    parameters.Add(name: "C_RcCod", dbType: DbType.String, value: pr.C_RcCod);
                    parameters.Add(name: "C_CodAlu", dbType: DbType.String, value: pr.C_CodAlu);

                    result = _dbConnection.Query<USP_S_ListaObligaciones>(s_command, parameters, commandType: CommandType.StoredProcedure, 
                        commandTimeout: 100);
                }
            }
            catch (Exception ex)
            {
                throw ex;
            }

            return result;
        }
    }

    public class USP_S_ListaObligaciones_Parameters
    {        
        public string C_RcCod { get; set; }
        public string C_CodAlu { get; set; }
    }
}
