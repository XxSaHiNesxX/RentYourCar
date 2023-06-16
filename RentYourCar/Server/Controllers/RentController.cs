using Microsoft.AspNetCore.Mvc;
using RentYourCar.Database.Entities;
using RentYourCar.Server.Services;

namespace RentYourCar.Server.Controllers
{
    [ApiController]
    [Route("[controller]")]
    public class RentController : Controller
    {
        private readonly IDatabaseService service;

        public RentController(IDatabaseService _service)
        {
            service = _service;
        }
        [HttpPost("add/")]
        public async Task<IActionResult> AddAsync([FromBody] CarRent carRent)
        {
            var response = await service.AddAsync(carRent);

            return Ok(response);
        }
        [HttpGet("browse/")]
        public async Task<IActionResult> BrowseAsync()
        {
            var response = await service.BrowseAsync();

            return Ok(response);
        }
        [HttpPost("rent/")]
        public async Task<IActionResult> RentAsync([FromBody] CarRent carRent)
        {
            var response = await service.Reserve(carRent.Id, carRent.EndRent);

            return Ok(response);
        }
    }
}
