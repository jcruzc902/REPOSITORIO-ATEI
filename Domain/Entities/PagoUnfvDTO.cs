using Domain.Helpers;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Domain.Entities
{
    public class PagoGeneralDTO
    {
        public string T_DependenciaDesc { get; set; }
        public string C_CodDependencia { get; set; }
        public decimal I_MontoTotal { get; set; }
        public string T_MontoTotal
        {
            get
            {
                return I_MontoTotal.ToString(FormatosDecimal.BASIC_DECIMAL);
            }
        }
    }

    public class PagoPorConceptoDTO
    {
        public int I_ConceptoID { get; set; }
        public string C_CodClasificador { get; set; }
        public string T_ConceptoPagoDesc { get; set; }
        public string T_ClasificadorDesc { get; set; }
        public decimal I_MontoTotal { get; set; }
        public string T_MontoTotal
        {
            get
            {
                return I_MontoTotal.ToString(FormatosDecimal.BASIC_DECIMAL);
            }
        }
    }

    public class ConceptoPorDependenciaDTO
    {
        public string T_DependenciaDesc { get; set; }
        public string C_CodDependencia { get; set; }
        public int I_ConceptoID { get; set; }
        public string C_CodClasificador { get; set; }
        public string T_ClasificadorDesc { get; set; }
        public string T_ConceptoPagoDesc { get; set; }
        public int I_Cantidad { get; set; }
        public decimal I_MontoTotal { get; set; }
        public string T_MontoTotal
        {
            get
            {
                return I_MontoTotal.ToString(FormatosDecimal.BASIC_DECIMAL);
            }
        }
    }

    public class PagoTotalDTO
    {
        public int I_Anio { get; set; }
        public string T_DependenciaDesc { get; set; }
        public decimal I_MontoGenerado { get; set; }
        public string T_MontoGenerado
        {
            get
            {
                return I_MontoGenerado.ToString(FormatosDecimal.BASIC_DECIMAL);
            }
        }
        public decimal I_MontoPagado { get; set; }
        public string T_MontoPagado
        {
            get
            {
                return I_MontoPagado.ToString(FormatosDecimal.BASIC_DECIMAL);
            }
        }
        public decimal I_MontoDeuda { get; set; }
        public string T_MontoDeuda
        {
            get
            {
                return I_MontoDeuda.ToString(FormatosDecimal.BASIC_DECIMAL);
            }
        }
    }

    public class PagoAlumnosTotalDTO
    {
        public int I_Anio { get; set; }
        public string T_DependenciaDesc { get; set; }
        public string C_CodRc { get; set; }
        public string C_CodAlu { get; set; }
        public string T_PersonaApp { get; set; }
        public string T_PersonaApm { get; set; }
        public string T_PersonaNom { get; set; }
        public decimal I_MontoGenerado { get; set; }
        public string T_MontoGenerado
        {
            get
            {
                return I_MontoGenerado.ToString(FormatosDecimal.BASIC_DECIMAL);
            }
        }
        public decimal I_MontoPagado { get; set; }
        public string T_MontoPagado
        {
            get
            {
                return I_MontoPagado.ToString(FormatosDecimal.BASIC_DECIMAL);
            }
        }
        public decimal I_MontoDeuda { get; set; }
        public string T_MontoDeuda
        {
            get
            {
                return I_MontoDeuda.ToString(FormatosDecimal.BASIC_DECIMAL);
            }
        }
    }
}
