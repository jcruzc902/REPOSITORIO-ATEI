using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Domain.Entities
{
    public class EstudianteEntity
    {
        public string C_RcCod { get; set; }
        public string C_CodAlu { get; set; }
        public string T_ApePaterno { get; set; }
        public string T_ApeMaterno { get; set; }
        public string T_Nombre { get; set; }
        public string C_NumDNI { get; set; }
        public string C_CodTipDoc { get; set; }
        public string C_CodModIng { get; set; }
        public string C_AnioIngreso { get; set; }
        public string D_FecNac { get; set; }
        public string C_Sexo { get; set; }     
        public string I_Accion { get; set; }
        public string I_IdPlan { get; set; } = "0";
    }
}
