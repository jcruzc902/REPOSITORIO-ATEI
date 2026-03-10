using Data;
using Data.Procedures;
using Data.Tables;
using Data.Types;
using Data.Views;
using Domain.Entities;
using Domain.Helpers;
using Domain.UnfvRepositorioClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace Domain.Services.Implementations
{
    public class EstudianteService : IEstudianteService
    {
        private readonly List<TC_CatalogoOpcion> _periodos;

        public EstudianteService()
        {
            _periodos = TC_CatalogoOpcion.FindByParametro((int)Parametro.Periodo);
        }

        public DataMatriculaResponse GrabarMatriculas(List<MatriculaEntity> dataMatriculas, TipoAlumno tipoAlumno, int currentUserId)
        {
            bool alumnosPregado = (tipoAlumno == TipoAlumno.Pregrado);

            var observados = new List<MatriculaObsEntity>();

            //Validando el código de alumno.
            observados.AddRange(
                dataMatriculas.Where(mat => CampoCodigoAlumnoIncorrecto(mat.C_CodAlu)).
                    Select(mat => Mapper.MatriculaEntity_To_MatriculaObsEntity(mat, false, "El campo Código de alumno es incorrecto."))
            );

            dataMatriculas.RemoveAll(mat => CampoCodigoAlumnoIncorrecto(mat.C_CodAlu));

            //Validando el cod_rc.
            observados.AddRange(
                dataMatriculas.Where(mat => CampoCodRcIncorrecto(mat.C_CodRC)).
                    Select(mat => Mapper.MatriculaEntity_To_MatriculaObsEntity(mat, false, "El campo Cod_Rc es incorrecto."))
            );

            dataMatriculas.RemoveAll(mat => CampoCodRcIncorrecto(mat.C_CodRC));

            //Validando el campo año.
            observados.AddRange(
                dataMatriculas.Where(mat => CampoAnioIncorrecto(mat.I_Anio)).
                    Select(mat => Mapper.MatriculaEntity_To_MatriculaObsEntity(mat, false, "El campo Año es incorrecto."))
            );

            dataMatriculas.RemoveAll(mat => CampoAnioIncorrecto(mat.I_Anio));

            //Validando el campo periodo.
            observados.AddRange(
                dataMatriculas.Where(mat => CampoPeriodoIncorrecto(mat.C_Periodo)).
                    Select(mat => Mapper.MatriculaEntity_To_MatriculaObsEntity(mat, false, "El campo Periodo es incorrecto."))
            );

            dataMatriculas.RemoveAll(mat => CampoPeriodoIncorrecto(mat.C_Periodo));

            //Validando  codigo de curso
            if (tipoAlumno.Equals(TipoAlumno.Pregrado))
            {
                observados.AddRange(
                    dataMatriculas.Where(mat => CampoCodCursoIncorrecto(mat.C_CodCurso)).
                    Select(mat => Mapper.MatriculaEntity_To_MatriculaObsEntity(mat, false, "El campo CodCurso es incorrecto."))
                );

                dataMatriculas.RemoveAll(mat => CampoCodCursoIncorrecto(mat.C_CodCurso));
            }

            //Validando códigos duplicados.
            var codigosRepetidos = dataMatriculas.GroupBy(x => new { x.C_CodRC, x.C_CodAlu, x.I_Anio, x.C_Periodo, x.C_CodCurso }).Where(x => x.Count() > 1);

            if (codigosRepetidos != null && codigosRepetidos.Count() > 0)
            {
                codigosRepetidos.ToList().ForEach(
                    c => c.ToList().ForEach(rep =>
                    {
                        observados.Add(Mapper.MatriculaEntity_To_MatriculaObsEntity(rep, false, "Registro repetido."));

                        dataMatriculas.RemoveAll(mat => mat.C_CodRC == rep.C_CodRC && mat.C_CodAlu == rep.C_CodAlu && mat.C_Periodo == rep.C_Periodo);
                    })
                );
            }

            //Validando el campo estado.
            observados.AddRange(
                dataMatriculas.Where(mat => CampoEstadoIncorrecto(mat.C_EstMat)).
                    Select(mat => Mapper.MatriculaEntity_To_MatriculaObsEntity(mat, false, "El campo Estado es incorrecto."))
            );

            dataMatriculas.RemoveAll(mat => CampoEstadoIncorrecto(mat.C_EstMat));

            //Validando el campo ingresante.
            observados.AddRange(
                dataMatriculas.Where(mat => CampoIngresanteIncorrecto(mat.B_Ingresante)).
                    Select(mat => Mapper.MatriculaEntity_To_MatriculaObsEntity(mat, false, "El campo Ingresante es incorrecto."))
            );

            dataMatriculas.RemoveAll(mat => CampoIngresanteIncorrecto(mat.B_Ingresante));

            //Validando el campo Creditos.
            observados.AddRange(
                dataMatriculas.Where(mat => CampoCreditoIncorrecto(mat.I_CredDesaprob, mat.I_Vez)).
                    Select(mat => Mapper.MatriculaEntity_To_MatriculaObsEntity(mat, false, "El campo Créditos es incorrecto."))
            );

            dataMatriculas.RemoveAll(mat => CampoCreditoIncorrecto(mat.I_CredDesaprob, mat.I_Vez));

            if (tipoAlumno.Equals(TipoAlumno.Pregrado))
            {
                //Validando el campo vez.
                observados.AddRange(
                    dataMatriculas.Where(mat => CampoVezIncorrecto(mat.I_CredDesaprob, mat.I_Vez)).
                        Select(mat => Mapper.MatriculaEntity_To_MatriculaObsEntity(mat, false, "El campo Vez es incorrecto."))
                );

                dataMatriculas.RemoveAll(mat => CampoVezIncorrecto(mat.I_CredDesaprob, mat.I_Vez));
            }

            if (dataMatriculas.Count > 0)
            {
                var grabarMatricula = new USP_IU_GrabarMatricula()
                {
                    B_AlumnosPregrado = alumnosPregado,
                    UserID = currentUserId,
                    D_FecRegistro = DateTime.Now,
                    I_TipoEstudio = tipoAlumno.Equals(TipoAlumno.Posgrado) ? 2 : (tipoAlumno.Equals(TipoAlumno.SegundaEspecialidad) ? 3 : (tipoAlumno.Equals(TipoAlumno.Residentado) ? 4 : 1))
                };

                var dataTable = Mapper.MatriculaEntity_To_DataTable(dataMatriculas);

                var grabarMatriculaResult = grabarMatricula.Execute(dataTable);

                observados.AddRange(grabarMatriculaResult.Where(r => !r.B_Success).Select(r => Mapper.DataMatriculaResult_To_MatriculaObsEntity(r)));
            }

            var result = new DataMatriculaResponse(observados);

            return result;
        }

        public IEnumerable<MatriculaDTO> GetMatriculaPregrado(int anio, int periodo)
        {
            var matriculas = VW_MatriculaAlumno.GetPregrado(anio, periodo);

            var result = matriculas.Select(m => Mapper.MatriculaDTO_To_VW_MatriculaAlumno(m));

            return result;
        }

        public IEnumerable<MatriculaDTO> GetMatriculaPosgrado(int anio, int periodo)
        {
            var matriculas = VW_MatriculaAlumno.GetPosgrado(anio, periodo);

            var result = matriculas.Select(m => Mapper.MatriculaDTO_To_VW_MatriculaAlumno(m));

            return result;
        }

        public IEnumerable<MatriculaDTO> GetMatriculaSegundaEspecialidad(int anio, int periodo)
        {
            var matriculas = VW_MatriculaAlumno.GetSegundaEspecialidad(anio, periodo);

            var result = matriculas.Select(m => Mapper.MatriculaDTO_To_VW_MatriculaAlumno(m));

            return result;
        }

        public IEnumerable<MatriculaDTO> GetMatriculaResidentado(int anio, int periodo)
        {
            var matriculas = VW_MatriculaAlumno.GetResidentado(anio, periodo);

            var result = matriculas.Select(m => Mapper.MatriculaDTO_To_VW_MatriculaAlumno(m));

            return result;
        }

        private bool CampoCodigoAlumnoIncorrecto(string codigoAlumno)
        {
            return String.IsNullOrWhiteSpace(codigoAlumno) || codigoAlumno.Length != 10;
        }

        private bool CampoCodRcIncorrecto(string codRc)
        {
            return String.IsNullOrWhiteSpace(codRc) || codRc.Length != 3;
        }

        private bool CampoAnioIncorrecto(int? anio)
        {
            return anio == null || anio < 1963;
        }

        private bool CampoPeriodoIncorrecto(string periodo)
        {
            return !_periodos.Any(p => p.T_OpcionCod.Equals(periodo));
        }

        private bool CampoEstadoIncorrecto(string estMat)
        {
            return String.IsNullOrWhiteSpace(estMat);
        }

        private bool CampoIngresanteIncorrecto(bool? B_Ingresante)
        {
            return B_Ingresante == null;
        }

        private bool CampoCodCursoIncorrecto(string codCur)
        {
            return String.IsNullOrWhiteSpace(codCur);
        }

        private bool CampoCreditoIncorrecto(int? I_CredDesaprob, int? vez)
        {
            if (!I_CredDesaprob.HasValue || I_CredDesaprob.Value < 0)
            {
                return true;
            }
            else
            {
                if (vez.HasValue && vez.Value > 1 && I_CredDesaprob.Value == 0)
                {
                    return true;
                }
            }

            return false;
        }

        private bool CampoVezIncorrecto(int? I_CredDesaprob, int? vez)
        {
            if (!vez.HasValue || vez.Value < 1)
            {
                return true;
            }
            else
            {
                if (I_CredDesaprob.HasValue && I_CredDesaprob.Value > 0 && vez.Value == 1)
                {
                    return true;
                }
            }

            return false;
        }

        private bool CampoApellidoPaternoIncorrecto(string apellidoPaterno)
        {
            return String.IsNullOrWhiteSpace(apellidoPaterno);
        }

        private bool CampoApellidoMaternoIncorrecto(string apellidoMaterno)
        {
            return String.IsNullOrWhiteSpace(apellidoMaterno);
        }

        private bool CampoNombresIncorrecto(string nombres)
        {
            return String.IsNullOrWhiteSpace(nombres);
        }

        private bool CampoNumeroDNIIncorrecto(string numDNI)
        {
            return String.IsNullOrWhiteSpace(numDNI);
        }

        private bool CampoTipoDocumentoIncorrecto(string tipoDocumento)
        {
            return String.IsNullOrWhiteSpace(tipoDocumento) || tipoDocumento.Length != 2;
        }

        private bool CampoModalidadIngresoIncorrecto(string modIngreso)
        {
            return String.IsNullOrWhiteSpace(modIngreso) || modIngreso.Length != 2;
        }

        private bool CampoSexoIncorrecto(string sexo)
        {
            return String.IsNullOrWhiteSpace(sexo) || sexo.Length != 1;
        }

        private bool CampoAccionIncorrecto(string accion)
        {
            var strings = new List<string> { "I", "U" };
            bool contains = strings.Contains(accion, StringComparer.OrdinalIgnoreCase);

            return String.IsNullOrWhiteSpace(accion) || accion.Length != 1 || !contains;
        }

        public MultaNoVotarResponse GrabarAlumnosConMultaPorVoto(List<AlumnoMultaNoVotarEntity> alumnoMultaNoVotarEntity, int currentUserId)
        {
            var observados = new List<MultaNoVotarSinRegistrarEntity>();

            //Validando el código de alumno.
            observados.AddRange(
                alumnoMultaNoVotarEntity.Where(a => CampoCodigoAlumnoIncorrecto(a.C_CodAlu)).
                    Select(a => Mapper.AlumnoMultaNoVotarEntity_To_MultaNoVotarSinRegistrarEntity(a, false, "El campo Código de alumno es incorrecto."))
            );

            alumnoMultaNoVotarEntity.RemoveAll(a => CampoCodigoAlumnoIncorrecto(a.C_CodAlu));

            //Validando el cod_rc.
            observados.AddRange(
                alumnoMultaNoVotarEntity.Where(a => CampoCodRcIncorrecto(a.C_CodRC)).
                    Select(a => Mapper.AlumnoMultaNoVotarEntity_To_MultaNoVotarSinRegistrarEntity(a, false, "El campo Cod_Rc es incorrecto."))
            );

            alumnoMultaNoVotarEntity.RemoveAll(a => CampoCodRcIncorrecto(a.C_CodRC));

            //Validando códigos duplicados.
            var codigosRepetidos = alumnoMultaNoVotarEntity.GroupBy(x => new { x.C_CodRC, x.C_CodAlu }).Where(x => x.Count() > 1);

            if (codigosRepetidos != null && codigosRepetidos.Count() > 0)
            {
                codigosRepetidos.ToList().ForEach(
                    c => c.ToList().ForEach(rep =>
                    {
                        observados.Add(Mapper.AlumnoMultaNoVotarEntity_To_MultaNoVotarSinRegistrarEntity(rep, false, "Código de alumno repetido."));

                        alumnoMultaNoVotarEntity.RemoveAll(a => a.C_CodRC == rep.C_CodRC && a.C_CodAlu == rep.C_CodAlu);
                    })
                );
            }

            //Validando el campo año.
            observados.AddRange(
                alumnoMultaNoVotarEntity.Where(a => CampoAnioIncorrecto(a.I_Anio)).
                    Select(a => Mapper.AlumnoMultaNoVotarEntity_To_MultaNoVotarSinRegistrarEntity(a, false, "El campo Año es incorrecto."))
            );

            alumnoMultaNoVotarEntity.RemoveAll(a => CampoAnioIncorrecto(a.I_Anio));

            //Validando el campo periodo.
            observados.AddRange(
                alumnoMultaNoVotarEntity.Where(a => CampoPeriodoIncorrecto(a.C_Periodo)).
                    Select(a => Mapper.AlumnoMultaNoVotarEntity_To_MultaNoVotarSinRegistrarEntity(a, false, "El campo Periodo es incorrecto."))
            );

            alumnoMultaNoVotarEntity.RemoveAll(a => CampoPeriodoIncorrecto(a.C_Periodo));

            if (alumnoMultaNoVotarEntity.Count > 0)
            {
                var grabarAlumnosSinVoto = new USP_I_GrabarAlumnoMultaNoVotar()
                {
                    UserID = currentUserId,
                    D_FecRegistro = DateTime.Now
                };

                var dataTable = Mapper.AlumnoMultaNoVotarEntity_To_DataTable(alumnoMultaNoVotarEntity);

                var grabarAlumnosSinVotoResult = grabarAlumnosSinVoto.Execute(dataTable);

                observados.AddRange(grabarAlumnosSinVotoResult.Select(r => Mapper.MultaNoVotarResult_To_MultaNoVotarSinRegistrarEntity(r)));
            }

            var result = new MultaNoVotarResponse(observados);

            return result;
        }

        public MatriculaDTO GetMatricula(int anio, int periodo, string codAlu, string codRc)
        {
            MatriculaDTO result = null;

            var matricula = VW_MatriculaAlumno.GetMatricula(anio, periodo, codAlu, codRc);

            if (matricula != null)
            {
                result = Mapper.MatriculaDTO_To_VW_MatriculaAlumno(matricula);
            }

            return result;
        }

        public string GetNombresCompletos(string codAlu)
        {
            return VW_MatriculaAlumno.GetNombresCompletos(codAlu);
        }

        public Response EliminarMatricula(int matAluID, int currentUserId)
        {
            ResponseData result;

            try
            {
                if (!TR_ObligacionAluCab.ExisteObligacionPorMatricula(matAluID))
                {

                    var sp = new USP_U_EliminarMatricula()
                    {
                        I_MatAluID = matAluID,
                        I_UsuarioMod = currentUserId
                    };

                    result = sp.Execute();
                }
                else
                {
                    result = new ResponseData()
                    {
                        Message = "El registro tiene obligaciones generadas."
                    };
                }
            }
            catch (Exception ex)
            {
                result = new ResponseData()
                {
                    Message = ex.Message
                };
            }

            return new Response(result);
        }

        public DataEstudianteResponse GrabarEstudiantes(List<EstudianteEntity> dataEstudiantes, int currentUserId)
        {
            var observados = new List<EstudianteObsEntity>();

            //Validando el código de alumno.
            observados.AddRange(
                dataEstudiantes.Where(mat => CampoCodigoAlumnoIncorrecto(mat.C_CodAlu)).
                    Select(mat => Mapper.EstudianteEntity_To_EstudianteObsEntity(mat, false, "El campo Código de alumno es incorrecto."))
            );

            dataEstudiantes.RemoveAll(mat => CampoCodigoAlumnoIncorrecto(mat.C_CodAlu));

            //Validando el cod_rc.
            observados.AddRange(
                dataEstudiantes.Where(mat => CampoCodRcIncorrecto(mat.C_RcCod)).
                    Select(mat => Mapper.EstudianteEntity_To_EstudianteObsEntity(mat, false, "El campo Cod_Rc es incorrecto."))
            );

            dataEstudiantes.RemoveAll(mat => CampoCodRcIncorrecto(mat.C_RcCod));

            //Validando el apellido paterno.
            observados.AddRange(
                dataEstudiantes.Where(mat => {
                    bool esApellidoIncorrecto = CampoApellidoPaternoIncorrecto(mat.T_ApePaterno);
                    bool esAccionValida = mat.I_Accion != "D";
                    return esApellidoIncorrecto && esAccionValida;
                }).
                    Select(mat => Mapper.EstudianteEntity_To_EstudianteObsEntity(mat, false, "El campo T_ApePaterno es incorrecto."))
            );

            dataEstudiantes.RemoveAll(mat => CampoApellidoPaternoIncorrecto(mat.T_ApePaterno) && mat.I_Accion != "D");

            //Validando el apellido materno.
            observados.AddRange(
               dataEstudiantes.Where(mat => CampoApellidoMaternoIncorrecto(mat.T_ApeMaterno) && mat.I_Accion != "D").
                    Select(mat => Mapper.EstudianteEntity_To_EstudianteObsEntity(mat, false, "El campo T_ApeMaterno es incorrecto."))
            );

            dataEstudiantes.RemoveAll(mat => CampoApellidoMaternoIncorrecto(mat.T_ApeMaterno) && mat.I_Accion != "D");

            //Validando el nombre
            observados.AddRange(
                dataEstudiantes.Where(mat => CampoNombresIncorrecto(mat.T_Nombre) && mat.I_Accion != "D").
                Select(mat => Mapper.EstudianteEntity_To_EstudianteObsEntity(mat, false, "El campo T_Nombre es incorrecto."))
            );

            dataEstudiantes.RemoveAll(mat => CampoNombresIncorrecto(mat.T_Nombre) && mat.I_Accion != "D");


            //Validando códigos duplicados.
            var codigosRepetidos = dataEstudiantes.GroupBy(x => new { x.C_RcCod, x.C_CodAlu, x.T_ApePaterno, x.T_ApeMaterno, x.T_Nombre, x.C_NumDNI, x.C_CodTipDoc, x.C_CodModIng, x.C_AnioIngreso, x.C_Sexo, x.D_FecNac, x.I_Accion }).Where(x => x.Count() > 1);

            if (codigosRepetidos != null && codigosRepetidos.Count() > 0)
            {
                codigosRepetidos.ToList().ForEach(
                    c => c.ToList().ForEach(rep =>
                    {
                        observados.Add(Mapper.EstudianteEntity_To_EstudianteObsEntity(rep, false, "Registro repetido."));

                        dataEstudiantes.RemoveAll(mat => mat.C_RcCod == rep.C_RcCod && mat.C_CodAlu == rep.C_CodAlu && mat.T_ApePaterno == rep.T_ApePaterno && mat.T_ApeMaterno == rep.T_ApeMaterno && mat.T_Nombre == rep.T_Nombre && mat.C_NumDNI == rep.C_NumDNI && mat.C_CodTipDoc == rep.C_CodTipDoc && mat.C_CodModIng == rep.C_CodModIng && mat.C_AnioIngreso == rep.C_AnioIngreso && mat.C_Sexo == rep.C_Sexo && mat.D_FecNac == rep.D_FecNac && mat.I_Accion == rep.I_Accion);
                    })
                );
            }

            //Validando el campo C_NumDNI.
            observados.AddRange(
                dataEstudiantes.Where(mat => CampoNumeroDNIIncorrecto(mat.C_NumDNI) && mat.I_Accion != "D").
                    Select(mat => Mapper.EstudianteEntity_To_EstudianteObsEntity(mat, false, "El campo C_NumDNI es incorrecto."))
            );

            dataEstudiantes.RemoveAll(mat => CampoNumeroDNIIncorrecto(mat.C_NumDNI) && mat.I_Accion != "D");

            //Validando el campo C_CodTipDoc.
            observados.AddRange(
                dataEstudiantes.Where(mat => CampoTipoDocumentoIncorrecto(mat.C_CodTipDoc) && mat.I_Accion != "D").
                    Select(mat => Mapper.EstudianteEntity_To_EstudianteObsEntity(mat, false, "El campo C_CodTipDoc es incorrecto."))
            );

            dataEstudiantes.RemoveAll(mat => CampoTipoDocumentoIncorrecto(mat.C_CodTipDoc) && mat.I_Accion != "D");

            //Validando el campo C_CodModIng.
            observados.AddRange(
                dataEstudiantes.Where(mat => CampoModalidadIngresoIncorrecto(mat.C_CodModIng) && mat.I_Accion != "D").
                    Select(mat => Mapper.EstudianteEntity_To_EstudianteObsEntity(mat, false, "El campo C_CodModIng es incorrecto."))
            );

            dataEstudiantes.RemoveAll(mat => CampoModalidadIngresoIncorrecto(mat.C_CodModIng) && mat.I_Accion != "D");

            //Validando el campo C_Sexo.
            observados.AddRange(
                dataEstudiantes.Where(mat => CampoSexoIncorrecto(mat.C_Sexo) && mat.I_Accion != "D").
                    Select(mat => Mapper.EstudianteEntity_To_EstudianteObsEntity(mat, false, "El campo C_Sexo es incorrecto."))
            );

            dataEstudiantes.RemoveAll(mat => CampoSexoIncorrecto(mat.C_Sexo) && mat.I_Accion != "D");

            //Validando el campo I_Accion.
            observados.AddRange(
                dataEstudiantes.Where(mat => CampoAccionIncorrecto(mat.I_Accion)).
                    Select(mat => Mapper.EstudianteEntity_To_EstudianteObsEntity(mat, false, "El campo I_Accion es incorrecto."))
            );

            dataEstudiantes.RemoveAll(mat => CampoAccionIncorrecto(mat.I_Accion));

            if (dataEstudiantes.Count > 0)
            {

                var alumnosClient = new AlumnosClient();

                var resultad = alumnosClient.GrabarAlumno(dataEstudiantes, currentUserId);


                var estudiantesDict = dataEstudiantes.ToDictionary(e => new EstudianteKey { C_RcCod = e.C_RcCod, C_CodAlu = e.C_CodAlu });

                // Iterar sobre los resultados de la API
                foreach (var response in resultad)
                {
                    if (!response.Success) // Si Success es false
                    {
                        // Buscar el estudiante correspondiente en el diccionario
                        if (estudiantesDict.TryGetValue(new EstudianteKey { C_RcCod = response.C_RcCod, C_CodAlu = response.C_CodAlu }, out var estudiante))
                        {
                            // Usar la función EstudianteEntity_To_EstudianteObsEntity para transformar el objeto
                            var estudianteObservado = Mapper.EstudianteEntity_To_EstudianteObsEntity(estudiante, response.Success, response.Message);

                            // Agregar el estudiante observado a la lista de observados
                            observados.Add(estudianteObservado);
                        }
                    }
                }

            }

            var result = new DataEstudianteResponse(observados);

            return result;
        }
    }
}
