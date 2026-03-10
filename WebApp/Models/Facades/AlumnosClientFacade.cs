using Domain.UnfvRepositorioClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using Domain.Entities;

namespace WebApp.Models.Facades
{
    public class AlumnosClientFacade : IAlumnosClientFacade
    {
        IAlumnosClient alumnosClient;

        public AlumnosClientFacade()
        {
            alumnosClient = new AlumnosClient();
        }

        public IEnumerable<AlumnoModel> GetByDocIdent(string codTipDoc, string numDNI)
        {
            IEnumerable<AlumnoModel> result;

            try
            {
                result = alumnosClient.GetByDocIdent(codTipDoc, numDNI);
            }
            catch (Exception ex)
            {
                result = new List<AlumnoModel>();
            }

            return result;
        }

        public AlumnoModel GetByID(string codRc, string codAlu)
        {
            AlumnoModel result;
            try
            {
                result = alumnosClient.GetByID(codRc, codAlu);
            }
            catch (Exception ex)
            {
                result = null;
            }

            return result;
        }

        public IEnumerable<EspecialidadAlumnoModel> GetEspecialidadesAlumno(string codAlu)
        {
            IEnumerable<EspecialidadAlumnoModel> result;

            try
            {
                var alumnos = alumnosClient.GetByCodAlu(codAlu);

                result = alumnos.Select(a => Mapper.AlumnoModel_To_EspecialidadAlumnoModel(a));
            }
            catch (Exception ex)
            {
                result = new List<EspecialidadAlumnoModel>();
            }

            return result;
        }

        public IEnumerable<AlumnoModel> GetByNombre(string Nombre, string Paterno, string Materno)
        {
            IEnumerable<AlumnoModel> result;

            try
            {
                result = alumnosClient.GetByNombre(Nombre, Paterno, Materno);
            }
            catch (Exception ex)
            {
                result = new List<AlumnoModel>();
            }

            return result;
        }

        public IEnumerable<AlumnoModel> GetByCodAlu(string codAlu)
        {
            IEnumerable<AlumnoModel> result;

            try
            {
                result = alumnosClient.GetByCodAlu(codAlu);
            }
            catch (Exception ex)
            {
                result = new List<AlumnoModel>();
            }

            return result;
        }
    }
}