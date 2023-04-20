using System;
using System.IO;
using System.Net.Mail;
using System.Web.UI.WebControls;

public partial class ContactForm : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        // Sprawdź, czy formularz został wysłany
        if (IsPostBack)
        {
            // Pobierz dane z pól formularza
            string name = txtName.Text;
            string email = txtEmail.Text;
            string subject = txtSubject.Text;
            string message = txtMessage.Text;

            // Sprawdź, czy pola formularza są wypełnione
            if (string.IsNullOrEmpty(name) || string.IsNullOrEmpty(email) || string.IsNullOrEmpty(subject) || string.IsNullOrEmpty(message))
            {
                lblMessage.Text = "Proszę wypełnić wszystkie pola formularza.";
                return;
            }

            // Przygotuj wiadomość e-mail
            MailMessage mail = new MailMessage();
            mail.From = new MailAddress(email);
            mail.To.Add("adres@serwisu.pl");
            mail.Subject = subject;
            mail.Body = message;

            // Dodaj załącznik, jeśli został przesłany
            if (fileAttachment.HasFile)
            {
                string fileName = Path.GetFileName(fileAttachment.PostedFile.FileName);
                mail.Attachments.Add(new Attachment(fileAttachment.PostedFile.InputStream, fileName));
            }

            // Wyślij wiadomość e-mail
            SmtpClient smtp = new SmtpClient();
            smtp.Host = "smtp.gmail.com";
            smtp.Port = 587;
            smtp.EnableSsl = true;
            smtp.UseDefaultCredentials = false;
            smtp.Credentials = new System.Net.NetworkCredential("adres@gmail.com", "hasło");
            smtp.Send(mail);

            // Wyczyszczenie pól formularza
            txtName.Text = "";
            txtEmail.Text = "";
            txtSubject.Text = "";
            txtMessage.Text = "";
            fileAttachment.Dispose();

            // Wyświetlenie komunikatu o sukcesie
            lblMessage.Text = "Wiadomość została wysłana.";
        }
    }
}
