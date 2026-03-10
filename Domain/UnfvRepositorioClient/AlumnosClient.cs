using Domain.Helpers;
using Domain.Entities;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Web;
using Newtonsoft.Json;

namespace Domain.UnfvRepositorioClient
{
    public class AlumnosClient : IAlumnosClient
    {
        private const string ApiKey = "7238e942-0498-4bc8-bce6-c041446eb5b9";

        public IEnumerable<AlumnoModel> GetByDocIdent(string codTipDoc, string numDNI)
        {
            string url, jsonResponse;
            HttpWebRequest request;
            IEnumerable<AlumnoModel> result;

            try
            {
                var uri = UnfvRepositorioClientConfiguration.BaseUrl("alumnos");

                var query = HttpUtility.ParseQueryString(uri.Query);

                query["codTipDoc"] = codTipDoc;

                query["numDNI"] = numDNI;

                uri.Query = query.ToString();

                url = uri.ToString();

                request = (HttpWebRequest)WebRequest.Create(url);
                
                request.Method = HttpVerb.GET.ToString();

                request.Headers.Add("X-API-Key", ApiKey);

                using (var response = (HttpWebResponse)request.GetResponse())
                using (var responseStream = response.GetResponseStream())
                using (var reader = new StreamReader(responseStream))
                {
                    jsonResponse = reader.ReadToEnd();

                    result = JsonConvert.DeserializeObject<List<AlumnoModel>>(jsonResponse);
                }
            }
            catch (WebException ex)
            {
                throw ex;
            }
            catch (Exception ex)
            {
                throw ex;
            }

            return result;
        }

        public AlumnoModel GetByID(string codRc, string codAlu)
        {
            string url, jsonResponse;
            HttpWebRequest request;
            AlumnoModel result;

            try
            {
                var uri = UnfvRepositorioClientConfiguration.BaseUrl("alumnos");

                var query = HttpUtility.ParseQueryString(uri.Query);

                query["codRc"] = codRc;

                query["codAlu"] = codAlu;

                uri.Query = query.ToString();

                url = uri.ToString();

                request = (HttpWebRequest)WebRequest.Create(url);

                request.Method = HttpVerb.GET.ToString();

                request.Headers.Add("X-API-Key", ApiKey);

                using (var response = (HttpWebResponse)request.GetResponse())
                using (var responseStream = response.GetResponseStream())
                using (var reader = new StreamReader(responseStream))
                {
                    jsonResponse = reader.ReadToEnd();

                    result = JsonConvert.DeserializeObject<AlumnoModel>(jsonResponse);
                }
            }
            catch (WebException ex)
            {
                throw ex;
            }
            catch (Exception ex)
            {
                throw ex;
            }

            return result;
        }

        public IEnumerable<AlumnoModel> GetByCodAlu(string codAlu)
        {
            string url, jsonResponse;
            HttpWebRequest request;
            IEnumerable<AlumnoModel> result;

            try
            {
                var uri = UnfvRepositorioClientConfiguration.BaseUrl("alumnos");

                var query = HttpUtility.ParseQueryString(uri.Query);

                query["codAlu"] = codAlu;

                uri.Query = query.ToString();

                url = uri.ToString();

                request = (HttpWebRequest)WebRequest.Create(url);

                request.Method = HttpVerb.GET.ToString();

                request.Headers.Add("X-API-Key", ApiKey);

                using (var response = (HttpWebResponse)request.GetResponse())
                using (var responseStream = response.GetResponseStream())
                using (var reader = new StreamReader(responseStream))
                {
                    jsonResponse = reader.ReadToEnd();

                    result = JsonConvert.DeserializeObject<List<AlumnoModel>>(jsonResponse);
                }
            }
            catch (WebException ex)
            {
                throw ex;
            }
            catch (Exception ex)
            {
                throw ex;
            }

            return result;
        }

        public IEnumerable<AlumnoModel> GetByNombre(string Nombre, string Paterno, string Materno)
        {
            string url, jsonResponse;
            HttpWebRequest request;
            IEnumerable<AlumnoModel> result;

            try
            {
                var uri = UnfvRepositorioClientConfiguration.BaseUrl("alumnos");

                var query = HttpUtility.ParseQueryString(uri.Query);

                query["Nombre"] = Nombre;

                query["Paterno"] = Paterno;

                query["Materno"] = Materno;

                uri.Query = query.ToString();

                url = uri.ToString();

                request = (HttpWebRequest)WebRequest.Create(url);

                request.Method = HttpVerb.GET.ToString();

                request.Headers.Add("X-API-Key", ApiKey);

                using (var response = (HttpWebResponse)request.GetResponse())
                using (var responseStream = response.GetResponseStream())
                using (var reader = new StreamReader(responseStream))
                {
                    jsonResponse = reader.ReadToEnd();

                    result = JsonConvert.DeserializeObject<List<AlumnoModel>>(jsonResponse);
                }
            }
            catch (WebException ex)
            {
                throw ex;
            }
            catch (Exception ex)
            {
                throw ex;
            }

            return result;
        }

        public IEnumerable<ServiceResponse> GrabarAlumno(IEnumerable<EstudianteEntity> alumnos, int currentUserId)
        {
            List<ServiceResponse> result = new List<ServiceResponse>();

            var uri = UnfvRepositorioClientConfiguration.BaseUrl("alumnos");
            var query = HttpUtility.ParseQueryString(uri.Query);
            query["currentUserID"] = currentUserId.ToString();
            uri.Query = query.ToString();
            string url = uri.ToString();

            // Procesar cada conjunto de datos
            result.AddRange(SendRequest(url, HttpVerb.POST.ToString(), alumnos.Where(a => a.I_Accion == "I").ToList()));
            result.AddRange(SendRequest(url, HttpVerb.PUT.ToString(), alumnos.Where(a => a.I_Accion == "U").ToList()));
            result.AddRange(SendRequest(url, HttpVerb.DELETE.ToString(), alumnos.Where(a => a.I_Accion == "D")
                                                                              .Select(a => new { a.C_RcCod, a.C_CodAlu })
                                                                              .ToList()));

            return result;
        }

        private IEnumerable<ServiceResponse> SendRequest<T>(string url, string method, List<T> alumnos)
        {
            if (alumnos.Count == 0) return Enumerable.Empty<ServiceResponse>();

            try
            {
                var request = (HttpWebRequest)WebRequest.Create(url);
                request.Method = method;
                request.ContentType = "application/json";
                request.Headers.Add("X-API-Key", ApiKey);

                string jsonData = JsonConvert.SerializeObject(alumnos);

                using (var streamWriter = new StreamWriter(request.GetRequestStream()))
                {
                    streamWriter.Write(jsonData);
                    streamWriter.Flush();
                }

                using (var response = (HttpWebResponse)request.GetResponse())
                using (var responseStream = response.GetResponseStream())
                using (var reader = new StreamReader(responseStream))
                {
                    string jsonResponse = reader.ReadToEnd();
                    return JsonConvert.DeserializeObject<List<ServiceResponse>>(jsonResponse);
                }
            }
            catch (WebException ex)
            {
                using (var stream = ex.Response.GetResponseStream())
                using (var reader = new StreamReader(stream))
                {
                    string errorResponse = reader.ReadToEnd();
                    throw new ApplicationException($"Error al llamar a la API: {errorResponse}", ex);
                }
            }
            catch (Exception ex)
            {
                throw new ApplicationException("Error inesperado al intentar registrar los alumnos.", ex);
            }
        }
    }
}
