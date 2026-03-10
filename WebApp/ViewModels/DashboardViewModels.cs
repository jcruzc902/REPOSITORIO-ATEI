using Domain.Entities;
using Domain.Services;
using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace WebApp.ViewModels
{
    public class DashboardViewModel
    {
        
        public int Dependencias { get; set; }
        public int PagosObligaciones { get; set; }
        public int PagosTasas { get; set; }
        public int Alumnos { get; set; }
    }
}