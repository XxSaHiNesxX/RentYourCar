using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace RentYourCar.Database.Entities
{
    public class CarRent : BaseEntity   
    {
        public Mark Mark { get; set; }
        public string Model { get; set; }
        public int Power { get; set; }
        public int Capacity { get; set; }
        public Fuel Fuel { get; set; }
        public Gear Gear { get; set; }
        [Column(TypeName = "decimal(10,2)")]
        public decimal Price { get; set; }
        public DateTime CreatedAt { get; set; }
        public DateTime EndRent { get; set; }
        public string Contact { get; set; }
        public string Description { get; set; }
        public string PhotoUrl { get; set; }

    }
}
