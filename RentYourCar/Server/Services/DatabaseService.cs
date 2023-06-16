using Microsoft.EntityFrameworkCore;
using RentYourCar.Database.DataConnections;
using RentYourCar.Database.Entities;

namespace RentYourCar.Server.Services
{
    public class DatabaseService:IDatabaseService
    {
        private readonly RentYourCarContext context;

        public DatabaseService(RentYourCarContext _context)
        {
            context = _context;
        }

        public async Task<CarRent> AddAsync(CarRent carRent)
        {
            carRent.Id = Guid.NewGuid();

            context.Add(carRent);

            await context.SaveChangesAsync();

            return carRent;
        }

        public async Task<List<CarRent>> BrowseAsync()
        {
            var cars = await context.CarRent.Where(x => x.EndRent < DateTime.Now).ToListAsync();

            return cars;
        }

        public async Task<CarRent> Reserve(Guid id, DateTime date)
        {
            var car = await context.CarRent.Where(x => x.Id == id).FirstOrDefaultAsync();

            if (car != null)
            {
                car.EndRent = date;
            }
            context.Update(car);

            await context.SaveChangesAsync();

            return car;
        }
    }
}
