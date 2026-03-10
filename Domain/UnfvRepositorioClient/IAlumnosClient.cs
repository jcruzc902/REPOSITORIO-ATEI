using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Domain.Entities;

namespace Domain.UnfvRepositorioClient
{
    public interface IAlumnosClient
    {
        IEnumerable<AlumnoModel> GetByDocIdent(string codTipDoc, string numDNI);

        AlumnoModel GetByID(string codRc, string codAlu);

        IEnumerable<AlumnoModel> GetByCodAlu(string codAlu);

        IEnumerable<AlumnoModel> GetByNombre(string Nombre, string Paterno, string Materno);

        IEnumerable<ServiceResponse> GrabarAlumno(IEnumerable<EstudianteEntity> alumnos, int currentUserId);
    }
}
