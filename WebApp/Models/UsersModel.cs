using Domain.Helpers;
using Domain.Services;
using Domain.Entities;
using DHelpers = Domain.Helpers;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using WebApp.ViewModels;
using CL_CustomMail;
using System.Configuration;
using System.Net.Mail;
using System.Net;

namespace WebApp.Models
{

    public class UsersModel
    {
        private readonly IUser _user;
        private readonly CorreoAplicacion _correoAplicacion;
        private readonly string appName;

        public UsersModel()
        {
            _user = new User();
            _correoAplicacion = new CorreoAplicacion();
            appName = ConfigurationManager.AppSettings["AppName"];
        }

        public List<UserViewModel> Find()
        {
            List<UserViewModel> result = new List<UserViewModel>();

            foreach (var item in _user.Find())
            {
                result.Add(new UserViewModel(item));
            }

            return result;
        }

        public UserRegisterViewModel Find(int userId)
        {
            return new UserRegisterViewModel(_user.Get(userId));
        }

        public DHelpers.Response GetUserState(string username)
        {
            return _user.GetUserState(username);
        }


        public DHelpers.Response ChangeState(int userId, bool stateValue, int currentUserId, string returnUrl)
        {
            User userRegister = new User()
            {
                UserId = userId,
                Enabled = stateValue
            };

            DHelpers.Response result = _user.ChangeState(userRegister, currentUserId);
            result.Action = returnUrl;

            if (result.Value)
            {
                ResponseModel.Success(result, string.Empty, false);
            }
            else
            {
                ResponseModel.Error(result);
            }

            return result;
        }

        public DHelpers.Response Save(UserRegisterViewModel userRegisterViewModel, int currentUserId, string urlLink = "")
        {
            User user = new User()
            {
                UserId = userRegisterViewModel.UserId,
                UserName = userRegisterViewModel.UserName,
                Person = new Persona()
                {
                    Id = userRegisterViewModel.PersonId,
                    Nombre = userRegisterViewModel.PersonName,
                    correo = userRegisterViewModel.Email,
                },
                Rol = new RolAplicacion()
                {
                    Id = userRegisterViewModel.RoleId,
                },
                Dependencia = new Dependencia()
                {
                    Id = userRegisterViewModel.DependenciaId
                }
            };

            var saveOption = userRegisterViewModel.UserId.HasValue ? SaveOption.Update : SaveOption.Insert;
            DHelpers.Response result = _user.Save(user, currentUserId, saveOption);

            if (result.Value)
            {
                if (saveOption == SaveOption.Update)
                {
                    result.Success(false);
                }
                else
                {
                    return SendMailNewAccount(user, result.CurrentID, urlLink);
                }
            }
            else
            {
                result.Error(true);
            }

            return result;
        }


        private DHelpers.Response SendMailNewAccount(User usuario, string newPassword, string link)
        {
            var result = new DHelpers.Response();

            var correo = _correoAplicacion.Find().SingleOrDefault(x => x.Enabled);

            if (!string.IsNullOrEmpty(usuario.Person.correo) && correo != null)
            {
                try
                {
                    MailMessage mail = new MailMessage();
                    mail.From = new MailAddress(correo.Address);
                    mail.To.Add(usuario.Person.correo);
                    mail.Subject = "UNFV - " + appName + " - Restablecimiento de contraseña de usuario";
                    mail.IsBodyHtml = true;

                    // Cuerpo del correo (HTML)
                    string body = "<html>" +
                                    "<body>" +
                                        "<div style='font-family: Arial;'>" +
                                            "<h2 style='color: #2b4a84;'>UNIVERSIDAD NACIONAL FEDERICO VILLARREAL</h2>" +
                                            "<h3>Oficina de Tesorería</h3>" +
                                            "<p>Se ha reestablecido la contraseña de manera exitosa.</p>" +
                                            "<p><strong>Nombre de usuario:</strong> " + usuario.UserName + "</p>" +
                                            "<p><strong>Nueva contraseña:</strong> " + newPassword + "</p>" +
                                            "<p><a href='" + link + "' style='display:inline-block;padding:10px 20px;background-color:#2b4a84;color:#fff;text-decoration:none;border-radius:5px;'>Ir a la aplicación</a></p>" +
                                        "</div>" +
                                    "</body>" +
                                  "</html>";

                    mail.Body = body;

                    SmtpClient smtp = new SmtpClient(correo.HostName, correo.Port);
                    smtp.EnableSsl = true;
                    smtp.Credentials = new NetworkCredential(correo.Address, correo.Password);
                    smtp.Send(mail);

                    result = new DHelpers.Response()
                    {
                        Value = true,
                        Message = "La contraseña ha sido modificada y enviada al correo electrónico " + usuario.Person.correo,
                        Icon = "fa fa-check-circle",
                        Color = "success"
                    };
                }
                catch (Exception ex)
                {
                    result = new DHelpers.Response()
                    {
                        Value = false,
                        Message = "La contraseña fue modificada, pero ocurrió un error al enviar el correo electrónico.<br/><br/>" + ex.Message,
                        Icon = "fa fa-exclamation-circle",
                        Color = "warning"
                    };
                }
            }

            else
            {
                result.Message = "<p><b>Creación de usuario </b></p>&nbsp;<br />" +
                                 "<p class=\"text-justify\">El usuario <b>" + usuario.UserName + "</b> no tiene una cuenta de correo registrada, no ha indicado una dirección a la cual enviar la nueva contraseña o no se ha encontrado un correo habilitado para realizar esta acción..<br />Por favor, tome nota de la contraseña y entréguela al usuario correspondiente.</p>" +
                                 "<ul class=\"pull-left\">" +
                                    "<li class=\"text-left\">El Nombre de usuario es: <b>" + usuario.UserName + "</b></li>" +
                                    "<li class=\"text-left\">La Contraseña es: <b>" + newPassword + "</b> </li>" +
                                 "</ul>";
                result.Icon = "fa fa-exclamation-circle";
                result.Color = "warning";
                result.CurrentID = "display: none;";
            }

            return result;
        }

    }
}