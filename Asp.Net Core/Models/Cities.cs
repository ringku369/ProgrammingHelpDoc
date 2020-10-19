using System;
using System.Collections.Generic;

namespace WebApplication1.Models
{
    public partial class Cities
    {
        public Cities()
        {
            Users = new HashSet<Users>();
        }

        public long Id { get; set; }
        public long? Code { get; set; }
        public long CountryId { get; set; }
        public string Name { get; set; }
        public DateTime? CreatedAt { get; set; }
        public DateTime? UpdatedAt { get; set; }

        public virtual Countries Country { get; set; }
        public virtual ICollection<Users> Users { get; set; }
    }
}
