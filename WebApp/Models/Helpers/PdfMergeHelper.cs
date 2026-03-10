using System.Collections.Generic;
using System.IO;
using PdfSharp.Pdf;
using PdfSharp.Pdf.IO;

namespace WebApp.Models.Helpers
{
    //SE CREO PARA FUSIONAR LOS REPORTES PDF DE TODAS LAS OBLIGACIONES
    public static class PdfMergeHelper
    {
        public static byte[] Merge(List<byte[]> pdfs)
        {
            using (var output = new PdfDocument())
            {
                foreach (var pdf in pdfs)
                {
                    using (var input = PdfReader.Open(new MemoryStream(pdf), PdfDocumentOpenMode.Import))
                    {
                        foreach (var page in input.Pages)
                            output.AddPage(page);
                    }
                }
                using (var ms = new MemoryStream())
                {
                    output.Save(ms, false);
                    return ms.ToArray();
                }
            }
        }
    }
}
