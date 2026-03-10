using Domain.Entities;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Domain.Helpers
{
    public class DataEstudianteResponse
    {
        public DataEstudianteResponse()
        {
            DataEstudiantesObs = new List<EstudianteObsEntity>();
        }

        public DataEstudianteResponse(List<EstudianteObsEntity> dataEstudiantesObs)
        {
            this.DataEstudiantesObs = dataEstudiantesObs;

            Success = true;

            Message = "La importación de data de estudiantes al repositorio ha finalizado.";

            if (DataEstudiantesObs.Count > 0)
                Message = Message + " Se ha encontrado: " + DataEstudiantesObs.Count.ToString() +
                    " observacion(es). Haga <a href='cargar-estudiantes-repo/resultado'>click aquí</a> para descargar la lista de observaciones.";
        }

        public bool Success { get; set; }

        public string Message { get; set; }

        public List<EstudianteObsEntity> DataEstudiantesObs { get; set; }
    }

    public class EstudianteKey
    {
        public string C_RcCod { get; set; }
        public string C_CodAlu { get; set; }

        // Sobrescribir Equals
        public override bool Equals(object obj)
        {
            return obj is EstudianteKey key &&
                   C_RcCod == key.C_RcCod &&
                   C_CodAlu == key.C_CodAlu;
        }

        // Implementar GetHashCode manualmente
        public override int GetHashCode()
        {
            unchecked // Permite overflow sin lanzar una excepción
            {
                int hash = 17;
                hash = hash * 23 + (C_RcCod != null ? C_RcCod.GetHashCode() : 0);
                hash = hash * 23 + (C_CodAlu != null ? C_CodAlu.GetHashCode() : 0);
                return hash;
            }
        }
    }


}
