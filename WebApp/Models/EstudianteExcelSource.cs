using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Domain.Entities;
using Domain.Helpers;
using ExcelDataReader;

namespace WebApp.Models
{
    public class EstudianteExcelSource : IEstudianteSource
    {
        readonly string[] expectedCol = { "C_RcCod", "C_CodAlu", "T_ApePaterno", "T_ApeMaterno", "T_Nombre", "C_NumDNI", "C_CodTipDoc", "C_CodModIng", "C_AnioIngreso", "D_FecNac", "C_Sexo", "I_Accion" };

        public List<EstudianteEntity> GetList(string filePath)
        {
            var dataEstudiantes = new List<EstudianteEntity>();

            string[] colNames;

            using (var stream = File.Open(filePath, FileMode.Open, FileAccess.Read))
            {
                using (var reader = ExcelReaderFactory.CreateReader(stream))
                {
                    bool isFirstSheet = true;

                    do
                    {
                        if (isFirstSheet)
                        {
                            int i = 0;

                            while (reader.Read())
                            {
                                if (i == 0)
                                {
                                    colNames = new string[]
                                        {
                                                reader.GetValue(0)?.ToString(),
                                                reader.GetValue(1)?.ToString(),
                                                reader.GetValue(2)?.ToString(),
                                                reader.GetValue(3)?.ToString(),
                                                reader.GetValue(4)?.ToString(),
                                                reader.GetValue(5)?.ToString(),
                                                reader.GetValue(6)?.ToString(),
                                                reader.GetValue(7)?.ToString(),
                                                reader.GetValue(8)?.ToString(),
                                                reader.GetValue(9)?.ToString(),
                                                reader.GetValue(10)?.ToString(),
                                                reader.GetValue(11)?.ToString()
                                        };

                                    if (!expectedCol.SequenceEqual(colNames))
                                        throw new Exception("Las columnas no son las esperadas");
                                    i++;
                                }
                                else
                                {
                                    dataEstudiantes.Add(Mapper.EstudianteReader_To_EstudianteEntity(reader));
                                }
                            }
                            isFirstSheet = false; // Ya hemos validado la primera hoja
                        }                        

                    } while (reader.NextResult());
                }
            }

            return dataEstudiantes;
        }
    }
}
