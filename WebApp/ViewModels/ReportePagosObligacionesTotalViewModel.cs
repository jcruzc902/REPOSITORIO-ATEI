using Domain.Helpers;
using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Globalization;
using System.Linq;
using System.Web;

namespace WebApp.ViewModels
{
    public class ReportePagosObligacionesTotalViewModel
    {
        public ReportePagosObligacionesTotalViewModel()
        {
            tipoEstudio = TipoEstudio.Pregrado;
        }

        [Required]
        public string tipoReporte { get; set; }

        public int? anio { get; set; }

        public TipoEstudio tipoEstudio { get; set; }

        public string dependencia { get; set; }

        public int? idDependencia { get; set; }

        public ReportePagosUnfvTotalPorAñoViewModel reportePagosTotalPorAñoViewModel { get; set; }

        public ReportePagosUnfvTotalPorAlumnoViewModel reportePagosTotalPorAlumnoViewModel { get; set; }
    }
}