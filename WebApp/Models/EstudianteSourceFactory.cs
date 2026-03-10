using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WebApp.Models
{
    public class EstudianteSourceFactory
    {
        public static IEstudianteSource Get(string extension)
        {
            IEstudianteSource estudianteSource;

            switch (extension.ToLower())
            {
                case ".xls":
                    estudianteSource = new EstudianteExcelSource();
                    break;

                case ".xlsx":
                    estudianteSource = new EstudianteExcelSource();
                    break;

                default:
                    throw new Exception("Tipo de archivo desconocido.");
            }

            return estudianteSource;
        }
    }
}
