using Microsoft.EntityFrameworkCore;
using RentYourCar.Database.Entities;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace RentYourCar.Database.DataConnections
{
    public class RentYourCarContext : DbContext
    {
        public RentYourCarContext(DbContextOptions<RentYourCarContext> options) : base(options) 
        { 

        }
        public virtual DbSet<CarRent> CarRent { get; set; }
    }
}
