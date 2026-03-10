using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Http;
using System.Web.Mvc;
using System.Web.Optimization;
using System.Web.Routing;
using System.Web.Security;
using WebApp.App_Start;
using WebMatrix.WebData;

namespace WebApp
{
    public class MvcApplication : System.Web.HttpApplication
    {
        protected void Application_Start()
        {
            ServicePointManager.SecurityProtocol =
    SecurityProtocolType.Tls |
    SecurityProtocolType.Tls11 |
    SecurityProtocolType.Tls12 |
    (SecurityProtocolType)3072;

            GlobalConfiguration.Configure(WebApiConfig.Register);
            AreaRegistration.RegisterAllAreas();
            FilterConfig.RegisterGlobalFilters(GlobalFilters.Filters);
            RouteConfig.RegisterRoutes(RouteTable.Routes);
            BundleConfig.RegisterBundles(BundleTable.Bundles);

            //ServicePointManager.SecurityProtocol = (SecurityProtocolType)48 | (SecurityProtocolType)192 | (SecurityProtocolType)768 | (SecurityProtocolType)3072;

            if (!WebSecurity.Initialized)
            {
                WebSecurity.InitializeDatabaseConnection("BD_CtasPorCobrarConnection", "TC_Usuario", "UserId", "UserName", autoCreateTables: false);
                if (Roles.Enabled)
                {
                    if (!Roles.RoleExists("Administrador"))
                        Roles.CreateRole("Administrador");

                    if (!Roles.RoleExists("Consulta"))
                        Roles.CreateRole("Consulta");

                    if (!Roles.RoleExists("Contabilidad"))
                        Roles.CreateRole("Contabilidad");

                    if (!Roles.RoleExists("Tesorería"))
                        Roles.CreateRole("Tesorería");

                    if (!Roles.RoleExists("Dependencia"))
                        Roles.CreateRole("Dependencia");

                }
            }
        }
    }

}
