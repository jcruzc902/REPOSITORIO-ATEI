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
    public class USP_S_ReporteTotalObligacionesPorFacultad
    {
        public string T_FacDesc { get; set; }
        public string C_CodRc { get; set; }
        public string C_CodAlu { get; set; }
        public string T_ApePaterno { get; set; }
        public string T_ApeMaterno { get; set; }
        public string T_Nombre { get; set; }
        public decimal I_MontoDeuda { get; set; }
        public decimal I_MontoGenerado { get; set; }
        public decimal I_MontoPagado { get; set; }
        public int I_Anio { get; set; }

        public static readonly int TotalAlumnos = 2;
        public static readonly int TotalFacultad = 1;       


        public static IEnumerable<USP_S_ReporteTotalObligacionesPorFacultad> ReporteTotalPorFacultad(int tipoEstudio, int? anio)
        {
            IEnumerable<USP_S_ReporteTotalObligacionesPorFacultad> result;
            DynamicParameters parameters;

            try
            {
                string s_command = @"USP_S_ReporteTotalObligacionesPorFacultad";

                parameters = new DynamicParameters();
                parameters.Add(name: "I_TipoReporte", dbType: DbType.Int32, value: TotalFacultad);
                parameters.Add(name: "I_TipoEstudio", dbType: DbType.Int32, value: tipoEstudio);
                parameters.Add(name: "I_Anio", dbType: DbType.Int32, value: anio);

                using (var _dbConnection = new SqlConnection(Database.ConnectionString))
                {
                    result = _dbConnection.Query<USP_S_ReporteTotalObligacionesPorFacultad>(s_command, parameters, commandType: CommandType.StoredProcedure);
                }
            }
            catch (Exception ex)
            {
                throw ex;
            }

            return result;
        }

        public static IEnumerable<USP_S_ReporteTotalObligacionesPorFacultad> ReporteTotalPorAlumno(int tipoEstudio, int? anio, string codFac)
        {
            IEnumerable<USP_S_ReporteTotalObligacionesPorFacultad> result;
            DynamicParameters parameters;

            try
            {
                string s_command = @"USP_S_ReporteTotalObligacionesPorFacultad";

                parameters = new DynamicParameters();
                parameters.Add(name: "I_TipoReporte", dbType: DbType.Int32, value: TotalAlumnos);
                parameters.Add(name: "I_TipoEstudio", dbType: DbType.Int32, value: tipoEstudio);
                parameters.Add(name: "I_Anio", dbType: DbType.Int32, value: anio);
                parameters.Add(name: "C_CodFac", dbType: DbType.String, value: (codFac == "" ? null:codFac));

                using (var _dbConnection = new SqlConnection(Database.ConnectionString))
                {
                    result = _dbConnection.Query<USP_S_ReporteTotalObligacionesPorFacultad>(s_command, parameters, commandType: CommandType.StoredProcedure);
                }
            }
            catch (Exception ex)
            {
                throw ex;
            }

            return result;
        }        
    }
}
