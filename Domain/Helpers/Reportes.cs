using Data.Procedures;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Domain.Helpers
{
    public static class Reportes
    {
        public const string REPORTE_GENERAL = "G";

        public const string REPORTE_CONCEPTO = "C";

        public const string REPORTE_FACULTAD = "F";

        public const string REPORTE_TOTAL = "T";

        public const string REPORTE_POR_ALUMNO = "A";

        public static Dictionary<string, string> Listar()
        {
            return new Dictionary<string, string>
            {
                { REPORTE_GENERAL, "Reporte de Pagos General" },
                { REPORTE_CONCEPTO, "Reporte de Pagos por Conceptos" },
                { REPORTE_FACULTAD, "Reporte de Pagos por Dependencia" }
            };
        }

        public static Dictionary<string, string> ListarNuevo()
        {
            return new Dictionary<string, string>
            {
                //{ REPORTE_TOTAL, "Reporte de Pagos Total" },
                { REPORTE_POR_ALUMNO, "Reporte de Pagos por alumno" }
            };
        }
    }
}

