using Microsoft.AspNetCore.Components;
using Newtonsoft.Json;
using Radzen.Blazor;
using RentYourCar.Database.Entities;
using System;
using System.Collections;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http.Json;
using System.Text;
using System.Text.Json;
using System.Threading.Tasks;

namespace RentYourCar.SharedUI.Pages
{
    public partial class Fleet
    {
        [Inject]
        HttpClient httpClient { get; set; }
        public CarRent NewCartToRent { get; set; } = new();
        public List<CarRent> CarRents { get; set; } = new();
        public DateTime ReserveDate { get; set; }
        protected override async Task OnInitializedAsync()
        {
            ReserveDate = DateTime.Now;
            await BrowseCars();
            await base.OnInitializedAsync();
        }
        private async Task AddNewCarRent()
        {
            NewCartToRent.CreatedAt = DateTime.Now;
            try
            {
                var result = await httpClient.PostAsJsonAsync("/Rent/Add", NewCartToRent);

                if (result.IsSuccessStatusCode)
                {
                    await BrowseCars();
                }
            }
            catch (Exception ex)
            {

            }

        }
        private async Task BrowseCars()
        {
            try
            {
                var result = await httpClient.GetStringAsync("/Rent/Browse");

                if (result != null)
                {
                    CarRents = await Task.Run(() => JsonConvert.DeserializeObject<List<CarRent>>(result.ToString()));
                }
                StateHasChanged();
            }
            catch (Exception ex)
            {

            }
        }
        private async Task ReserveCar(Guid id)
        {
            try
            {
                var car = CarRents.Where(x => x.Id == id).FirstOrDefault();

                if (car != null)
                {
                    car.EndRent = ReserveDate;
                    var result = await httpClient.PostAsJsonAsync($"/Rent/rent/", car);

                    if (result != null)
                    {
                        await BrowseCars();
                    }
                }

            }
            catch (Exception ex)
            {

            }
        }
    }
}
