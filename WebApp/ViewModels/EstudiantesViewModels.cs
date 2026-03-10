using Domain.Helpers;
using Domain.UnfvRepositorioClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WebApp.ViewModels
{
    public class SeleccionarArchivoViewModel
    {
        public string Color { get; set; }
        public TipoAlumno TipoAlumno { get; set; }
        public TipoArchivoAlumno TipoArchivoAlumno { get; set; }
        public string Action { get; set; }
    }

    public class ConsultaEstudianteViewModel
    {     
        public string codAlumno { get; set; }

        public string nomAlumno { get; set; }

        public string apePaternoAlumno { get; set; }

        public string apeMaternoAlumno { get; set; }

        public IEnumerable<AlumnoModel> resultado;

        public ConsultaEstudianteViewModel()
        {
           

            resultado = new List<AlumnoModel>();
        }
    }
}