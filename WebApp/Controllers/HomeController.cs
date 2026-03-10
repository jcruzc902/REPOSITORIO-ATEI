using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Data.SqlClient;
using System.Configuration;
using WebApp.ViewModels;

namespace WebApp.Controllers
{
    [Authorize]
    public class HomeController : Controller
    {
        /*
        [AllowAnonymous]
        public ActionResult Dashboard()
        {
            ViewBag.Title = "Dashboard";

            return View("Index");
        }
        */
        

        // GET: Home
        [AllowAnonymous]
        public ActionResult Index()
        {
            /*ViewBag.Title = "Dashboard";

            return View();
            */


            DashboardViewModel model = new DashboardViewModel();

            string conn = ConfigurationManager.ConnectionStrings["BD_CtasPorCobrarConnection"].ConnectionString;

            using (SqlConnection con = new SqlConnection(conn))
            {
                con.Open();


                model.Dependencias = ObtenerConteo(con, "TC_DependenciaUNFV");
                model.Alumnos = ObtenerConteo(con, "TC_MatriculaAlumno");
                model.PagosTasas = ObtenerConteo(con, "VW_PagoTasas");
                model.PagosObligaciones = ObtenerConteo(con, "VW_PagoBancoObligaciones");
            }

            return View(model);
        }

        

        [AllowAnonymous]
        private int ObtenerConteo(SqlConnection con, string tabla)
        {
            string sql = $"SELECT COUNT(*) FROM {tabla} ";

            using (SqlCommand cmd = new SqlCommand(sql, con))
            {
                return (int)cmd.ExecuteScalar();
            }
        }


        //------------------------------------------------------------------------------------------------------------------

        [HttpGet]
        [AllowAnonymous]
        public JsonResult ObtenerGraficoObligacionesMonto(int periodo)
        {
            var txt_mes = new Dictionary<int, string>()
            {
                { 1, "Ene" },
                { 2, "Feb" },
                { 3, "Mar" },
                { 4, "Abr" },
                { 5, "May" },
                { 6, "Jun" },
                { 7, "Jul" },
                { 8, "Ago" },
                { 9, "Sep" },
                { 10, "Oct" },
                { 11, "Nov" },
                { 12, "Dic" }
            };

            var categorias = new List<object[]>();
            categorias.Add(new object[] { "Mes", "Obligaciones - " + periodo });

            for (int inicio = 1; inicio <= 12; inicio++)
            {
                string mes = txt_mes[inicio];
                decimal monto = MontoObligaciones(inicio, periodo);

                categorias.Add(new object[] { mes, monto });
            }

            return Json(categorias, JsonRequestBehavior.AllowGet);
        }

        private decimal MontoObligaciones(int mes, int periodo)
        {
            decimal monto = 0;

            DateTime fechaInicial = new DateTime(periodo, mes, 1);
            DateTime fechaSiguienteMes = fechaInicial.AddMonths(1);

            string connectionString = ConfigurationManager.ConnectionStrings["BD_CtasPorCobrarConnection"].ConnectionString;

            using (SqlConnection cn = new SqlConnection(connectionString))
            {
                cn.Open();

                string sql = @"
                    SELECT ISNULL(SUM(I_MontoPago), 0)
                    FROM VW_PagoBancoObligaciones
                    WHERE D_FecPago >= @fecha_inicial
                      AND D_FecPago < @fecha_siguiente_mes";

                using (SqlCommand cmd = new SqlCommand(sql, cn))
                {
                    cmd.Parameters.AddWithValue("@fecha_inicial", fechaInicial);
                    cmd.Parameters.AddWithValue("@fecha_siguiente_mes", fechaSiguienteMes);

                    object result = cmd.ExecuteScalar();

                    if (result != null && result != DBNull.Value)
                    {
                        monto = Convert.ToDecimal(result);
                    }
                }
            }

            return monto;
        }

        //------------------------------------------------------------------------------------------------------------------

        [HttpGet]
        [AllowAnonymous]
        public JsonResult ObtenerGraficoObligacionesCantidad(int periodo2)
        {
            var txt_mes = new Dictionary<int, string>()
            {
                { 1, "Ene" },
                { 2, "Feb" },
                { 3, "Mar" },
                { 4, "Abr" },
                { 5, "May" },
                { 6, "Jun" },
                { 7, "Jul" },
                { 8, "Ago" },
                { 9, "Sep" },
                { 10, "Oct" },
                { 11, "Nov" },
                { 12, "Dic" }
            };

            var categorias = new List<object[]>();
            categorias.Add(new object[] { "Mes", "Obligaciones - " + periodo2 });

            for (int inicio = 1; inicio <= 12; inicio++)
            {
                string mes = txt_mes[inicio];
                decimal cantidad = CantidadObligaciones(inicio, periodo2);

                categorias.Add(new object[] { mes, cantidad });
            }

            return Json(categorias, JsonRequestBehavior.AllowGet);
        }

        private decimal CantidadObligaciones(int mes, int periodo2)
        {
            decimal cantidad = 0;

            DateTime fechaInicial = new DateTime(periodo2, mes, 1);
            DateTime fechaSiguienteMes = fechaInicial.AddMonths(1);

            string connectionString = ConfigurationManager.ConnectionStrings["BD_CtasPorCobrarConnection"].ConnectionString;

            using (SqlConnection cn = new SqlConnection(connectionString))
            {
                cn.Open();

                string sql = @"
                    SELECT COUNT(*)
                    FROM VW_PagoBancoObligaciones
                    WHERE D_FecPago >= @fecha_inicial
                      AND D_FecPago < @fecha_siguiente_mes";

                using (SqlCommand cmd = new SqlCommand(sql, cn))
                {
                    cmd.Parameters.AddWithValue("@fecha_inicial", fechaInicial);
                    cmd.Parameters.AddWithValue("@fecha_siguiente_mes", fechaSiguienteMes);

                    object result = cmd.ExecuteScalar();

                    if (result != null && result != DBNull.Value)
                    {
                        cantidad = Convert.ToDecimal(result);
                    }
                }
            }

            return cantidad;
        }



        //------------------------------------------------------------------------------------------------------------------



        [HttpGet]
        [AllowAnonymous]
        public JsonResult ObtenerGraficoTasasMonto(int periodo3)
        {
            var txt_mes = new Dictionary<int, string>()
            {
                { 1, "Ene" },
                { 2, "Feb" },
                { 3, "Mar" },
                { 4, "Abr" },
                { 5, "May" },
                { 6, "Jun" },
                { 7, "Jul" },
                { 8, "Ago" },
                { 9, "Sep" },
                { 10, "Oct" },
                { 11, "Nov" },
                { 12, "Dic" }
            };

            var categorias = new List<object[]>();
            categorias.Add(new object[] { "Mes", "Tasas - " + periodo3 });

            for (int inicio = 1; inicio <= 12; inicio++)
            {
                string mes = txt_mes[inicio];
                decimal monto = MontoTasas(inicio, periodo3);

                categorias.Add(new object[] { mes, monto });
            }

            return Json(categorias, JsonRequestBehavior.AllowGet);
        }

        private decimal MontoTasas(int mes, int periodo3)
        {
            decimal monto = 0;

            DateTime fechaInicial = new DateTime(periodo3, mes, 1);
            DateTime fechaSiguienteMes = fechaInicial.AddMonths(1);

            string connectionString = ConfigurationManager.ConnectionStrings["BD_CtasPorCobrarConnection"].ConnectionString;

            using (SqlConnection cn = new SqlConnection(connectionString))
            {
                cn.Open();

                string sql = @"
                    SELECT ISNULL(SUM(I_MontoPagado), 0)
                    FROM VW_PagoTasas
                    WHERE D_FecPago >= @fecha_inicial
                      AND D_FecPago < @fecha_siguiente_mes";

                using (SqlCommand cmd = new SqlCommand(sql, cn))
                {
                    cmd.Parameters.AddWithValue("@fecha_inicial", fechaInicial);
                    cmd.Parameters.AddWithValue("@fecha_siguiente_mes", fechaSiguienteMes);

                    object result = cmd.ExecuteScalar();

                    if (result != null && result != DBNull.Value)
                    {
                        monto = Convert.ToDecimal(result);
                    }
                }
            }

            return monto;
        }

        //------------------------------------------------------------------------------------------------------------------

        [HttpGet]
        [AllowAnonymous]
        public JsonResult ObtenerGraficoTasasCantidad(int periodo4)
        {
            var txt_mes = new Dictionary<int, string>()
            {
                { 1, "Ene" },
                { 2, "Feb" },
                { 3, "Mar" },
                { 4, "Abr" },
                { 5, "May" },
                { 6, "Jun" },
                { 7, "Jul" },
                { 8, "Ago" },
                { 9, "Sep" },
                { 10, "Oct" },
                { 11, "Nov" },
                { 12, "Dic" }
            };

            var categorias = new List<object[]>();
            categorias.Add(new object[] { "Mes", "Tasas - " + periodo4 });

            for (int inicio = 1; inicio <= 12; inicio++)
            {
                string mes = txt_mes[inicio];
                decimal cantidad = CantidadTasas(inicio, periodo4);

                categorias.Add(new object[] { mes, cantidad });
            }

            return Json(categorias, JsonRequestBehavior.AllowGet);
        }

        private decimal CantidadTasas(int mes, int periodo4)
        {
            decimal cantidad = 0;

            DateTime fechaInicial = new DateTime(periodo4, mes, 1);
            DateTime fechaSiguienteMes = fechaInicial.AddMonths(1);

            string connectionString = ConfigurationManager.ConnectionStrings["BD_CtasPorCobrarConnection"].ConnectionString;

            using (SqlConnection cn = new SqlConnection(connectionString))
            {
                cn.Open();

                string sql = @"
                    SELECT COUNT(*)
                    FROM VW_PagoTasas
                    WHERE D_FecPago >= @fecha_inicial
                      AND D_FecPago < @fecha_siguiente_mes";

                using (SqlCommand cmd = new SqlCommand(sql, cn))
                {
                    cmd.Parameters.AddWithValue("@fecha_inicial", fechaInicial);
                    cmd.Parameters.AddWithValue("@fecha_siguiente_mes", fechaSiguienteMes);

                    object result = cmd.ExecuteScalar();

                    if (result != null && result != DBNull.Value)
                    {
                        cantidad = Convert.ToDecimal(result);
                    }
                }
            }

            return cantidad;
        }



    }
}