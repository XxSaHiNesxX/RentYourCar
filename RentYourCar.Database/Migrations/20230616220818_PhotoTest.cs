using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace RentYourCar.Database.Migrations
{
    /// <inheritdoc />
    public partial class PhotoTest : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<string>(
                name: "PhotoUrl",
                table: "CarRent",
                type: "nvarchar(max)",
                nullable: false,
                defaultValue: "");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "PhotoUrl",
                table: "CarRent");
        }
    }
}
