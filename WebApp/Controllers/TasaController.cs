using ClosedXML.Excel;
using Domain.Helpers;
using Domain.Services.Implementations;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using WebApp.Models;
using WebApp.Models.Facades;
using WebApp.ViewModels;
using WebMatrix.WebData;

namespace WebApp.Controllers
{
    [Authorize(Roles = RoleNames.ADMINISTRADOR + ", " + RoleNames.TESORERIA + ", " + RoleNames.TESORERIA_AVANZADO)]
    public class TasaController : Controller
    {
        private int? _dependenciaUsuarioId;
        private SelectModel _selectModel;
        private ConceptoModel _conceptoModel;
        private CuentaDepositoModel _cuentasDeposito;
        PagosModel _pagosModel;

        public ITasaServiceFacade _tasaService;
        IProgramasClientFacade programasClientFacade;

        public TasaController()
        {
            _selectModel = new SelectModel();
            _conceptoModel = new ConceptoModel();
            _cuentasDeposito = new CuentaDepositoModel();
            _pagosModel = new PagosModel();

            _tasaService = new TasaServiceFacade();
            programasClientFacade = new ProgramasClientFacade();

            if (WebSecurity.IsAuthenticated)
            {
                _dependenciaUsuarioId = new UsersModel().Find(WebSecurity.CurrentUserId).DependenciaId;
            }
        }

        public ActionResult Index()
        {
            return View();
        }

        [Route("configuracion/tasas-y-servicios")]
        public ActionResult Tasas()
        {
            ViewBag.Title = "Tasas y Servicios";

            var lista = _tasaService.listarTodoTasas();

            return View(lista);
        }

        [HttpGet]
        public ActionResult DescargarExcel()
        {
            var lista = _tasaService.listarTodoTasas();

            using (var workbook = new XLWorkbook())
            {
                var worksheet = workbook.Worksheets.Add("Tasas");

                worksheet.Column("A").Width = 6;
                worksheet.Column("B").Width = 55;
                worksheet.Column("C").Width = 8;
                worksheet.Column("D").Width = 11;
                //worksheet.Column("H").Width = 20;
                //worksheet.Column("I").Width = 14;
                //worksheet.Column("J").Width = 20;
                //worksheet.Column("K").Width = 15;
                //worksheet.Column("L").Width = 14;
                //worksheet.Column("M").Width = 20;
                //worksheet.Column("N").Width = 14;

                int currentRow = 1;

                #region Header
                worksheet.Cell(currentRow, 1).Value = "Codigo";
                worksheet.Cell(currentRow, 2).Value = "Descripción";
                worksheet.Cell(currentRow, 3).Value = "Monto";
                worksheet.Cell(currentRow, 4).Value = "Clasificador";
                //worksheet.Cell(currentRow, 5).Value = "Código interno (BCP)";
                //worksheet.Cell(currentRow, 6).Value = "Código de depositante";
                //worksheet.Cell(currentRow, 7).Value = "Nombre de depositante";
                //worksheet.Cell(currentRow, 8).Value = "Fecha de pago";
                //worksheet.Cell(currentRow, 9).Value = "Total pagado";
                //worksheet.Cell(currentRow, 10).Value = "Banco";
                //worksheet.Cell(currentRow, 11).Value = "Número de cuenta";
                //worksheet.Cell(currentRow, 12).Value = "Estado";
                //worksheet.Cell(currentRow, 13).Value = "Fecha de emisión";
                //worksheet.Cell(currentRow, 14).Value = "Pago gravado";
                #endregion

                currentRow++;

                #region Body
                foreach (var item in lista)
                {
                    worksheet.Cell(currentRow, 1).SetValue<string>(item.C_CodTasa);
                    worksheet.Cell(currentRow, 2).SetValue<string>(item.T_ConceptoPagoDesc);
                    worksheet.Cell(currentRow, 3).SetValue<Decimal>(item.I_MontoTasa);
                    worksheet.Cell(currentRow, 4).SetValue<string>(item.T_clasificador);
                    //worksheet.Cell(currentRow, 5).SetValue<string>(item.codigoInterno);
                    //worksheet.Cell(currentRow, 6).SetValue<string>(item.codDepositante);
                    //worksheet.Cell(currentRow, 7).SetValue<string>(item.nomDepositante);
                    //worksheet.Cell(currentRow, 8).SetValue<DateTime>(item.fecPago);
                    //worksheet.Cell(currentRow, 9).SetValue<Decimal>(item.montoTotal);
                    //worksheet.Cell(currentRow, 10).SetValue<string>(item.entidadDesc);
                    //worksheet.Cell(currentRow, 11).SetValue<string>(item.numeroCuenta);
                    //worksheet.Cell(currentRow, 12).SetValue<string>(item.estadoComprobanteDesc);
                    //worksheet.Cell(currentRow, 13).SetValue<DateTime?>(item.fechaEmision);
                    //worksheet.Cell(currentRow, 14).SetValue<string>(item.gravadoDesc);

                    currentRow++;
                }
                #endregion

                //worksheet.Range(worksheet.Cell(2, 8), worksheet.Cell(currentRow, 8)).Style.DateFormat.Format = FormatosDateTime.BASIC_DATETIME;
                worksheet.Range(worksheet.Cell(2, 3), worksheet.Cell(currentRow, 3)).Style.NumberFormat.Format = FormatosDecimal.BASIC_DECIMAL;
                //worksheet.Range(worksheet.Cell(2, 13), worksheet.Cell(currentRow, 13)).Style.DateFormat.Format = FormatosDateTime.BASIC_DATETIME;

                using (var stream = new MemoryStream())
                {
                    workbook.SaveAs(stream);

                    var content = stream.ToArray();

                    return File(content, "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "Lista de Tasas.xlsx");
                }
            }
        }

        [Route("configuracion/tasas-y-servicios/agregar-tasa/")]
        public ActionResult CreateTasa()
        {
            ViewBag.Title = "Registrar Concepto";

            var listaTasas = _conceptoModel.Listar_CatalogoConceptos(TipoPago.Tasa, true);

            var items = new List<SelectListItem>();

            listaTasas.ForEach(t => items.Add(new SelectListItem() {
                Value = t.Id.Value.ToString(),
                Text = String.Format("{0} - {1}", t.ClasifCorto, t.NombreConcepto)
            }));

            ViewBag.Conceptos = new SelectList(items.OrderBy(i => i.Text), "Value", "Text");

            ViewBag.ListaCtasDepositoServicios = _selectModel.GetCtaDepoServicioParaTasas();


            var listaDependencias = programasClientFacade.GetDependencias();

            ViewBag.Facultades = new SelectList(listaDependencias, "Value", "TextDisplay");

            var model = new RegistrarTasaViewModel()
            {
                MostrarFormulario = false,
                PermitirCambiarTasa = true
            };

            return PartialView("_RegistrarConceptosPagoTasa", model);
        }


        [Route("configuracion/tasas-y-servicios/editar-tasa/{id}")]
        public ActionResult EditTasa(int id)
        {
            ViewBag.Title = "Editar Tasa";

            var model = _tasaService.ObtenerTasaUnfv(id);

            model.MostrarFormulario = true;

            model.PermitirCambiarTasa = false;

            model.CtaDepoServicioID = _tasaService.ObtenerCtaDepositoServicioIDs(id);

            ViewBag.ListaCtasDepositoServicios = _selectModel.GetCtaDepoServicioParaTasas(model.CtaDepoServicioID);

            var listaDependencias = programasClientFacade.GetDependencias();

            ViewBag.Facultades = new SelectList(listaDependencias, "Value", "TextDisplay",model.C_CodFac);

            return PartialView("_RegistrarConceptosPagoTasa", model);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Save(RegistrarTasaViewModel model)
        {
            Response result = new Response();

            if (ModelState.IsValid)
            {
                result = _tasaService.Grabar_TasaUnfv(model, WebSecurity.CurrentUserId);

                if (!result.Value)
                {
                    ModelState.AddModelError("", result.Message);
                }
            }
            else
            {
                string details = "";
                foreach (ModelState modelState in ViewData.ModelState.Values)
                {
                    foreach (ModelError error in modelState.Errors)
                    {
                        details += "\n " + error.ErrorMessage;
                    }
                }

                ResponseModel.Error(result, "Ha ocurrido un error con el envio de datos.\n" + details);
            }

            return PartialView("_MsgRegistrarConceptoTasa", result);
        }

        public JsonResult ChangeState(int RowID, bool B_habilitado)
        {
            var result = _tasaService.ChangeState(RowID, B_habilitado, WebSecurity.CurrentUserId, Url.Action("ChangeState", "Tasa"));

            return Json(result, JsonRequestBehavior.AllowGet);
        }

        public ActionResult ConsultaPagoTasa(ConsultaPagoTasasViewModel model)
        {
            ViewBag.Title = "Gestión Pago de Tasas";

            if (model.buscar)
            {
                model.resultado = _tasaService.listarPagoTasas(model);
            }

            ViewBag.EntidadesFinancieras = new SelectList(_selectModel.GetEntidadesFinancieras(), "Value", "TextDisplay", model.entidadFinanciera);

            ViewBag.CtaDeposito = new SelectList(
                model.entidadFinanciera.HasValue ? _selectModel.GetCtasDeposito(model.entidadFinanciera.Value) : new List<SelectViewModel>(), "Value", "TextDisplay", model.idCtaDeposito);

            return View(model);
        }

        public ActionResult EditarPagoTasa(int id)
        {
            ViewBag.Title = "Información del Pago";

            ViewBag.Tasas = new SelectList(_tasaService.listarTasas(), "Value", "TextDisplay");

            var pago = _tasaService.ObtenerPagoTasa(id);

            var model = new EditarPagoTasa()
            {
                I_PagoBancoID = pago.I_PagoBancoID,
                I_TasaUnfvID = pago.I_TasaUnfvID,
                I_NuevaTasaUnfvID = pago.I_TasaUnfvID,
                C_CodTasa = pago.C_CodTasa,
                T_ConceptoPagoDesc = pago.T_ConceptoPagoDesc,
                M_Monto = pago.M_Monto ?? 0,
                C_CodOperacion = pago.C_CodOperacion,
                C_CodigoInterno = pago.C_CodigoInterno,
                C_CodDepositante = pago.C_CodDepositante,
                T_NomDepositante = pago.T_NomDepositante,
                T_EntidadDesc = pago.T_EntidadDesc,
                C_NumeroCuenta = pago.C_NumeroCuenta,
                T_FecPago = pago.T_FecPago,
                I_MontoTotalPagado = pago.I_MontoTotalPagado,
                T_Observacion = pago.T_Observacion
            };

            return PartialView("_DetallePagoTasa", model);
        }

        public ActionResult GuardarPagoTasa(EditarPagoTasa model)
        {
            var result = _pagosModel.ActualizarPagoTasa(model.I_PagoBancoID, model.C_CodDepositante, model.I_NuevaTasaUnfvID ?? model.I_TasaUnfvID,
                model.T_Observacion, WebSecurity.CurrentUserId);

            return PartialView("_MsgGuardarPagoTasa", result);
        }
    }
}