using System;
using System.Collections.Generic;

namespace WebApplication1.Models
{
    public partial class Users
    {
        public long Id { get; set; }
        public long? Code { get; set; }
        public long? CountryId { get; set; }
        public long CityId { get; set; }
        public string Name { get; set; }
        public string Email { get; set; }
        public string Roll { get; set; }
        public string Username { get; set; }
        public string Password { get; set; }
        public DateTime? CreatedAt { get; set; }
        public DateTime? UpdatedAt { get; set; }

        public virtual Cities City { get; set; }
    }
}
