using RentYourCar.Database.Entities;

namespace RentYourCar.Server.Services
{
    public interface IDatabaseService
    {
        Task<CarRent> AddAsync(CarRent carRent);
        Task<List<CarRent>> BrowseAsync();
        Task<CarRent> Reserve(Guid id, DateTime date);
    }
}
