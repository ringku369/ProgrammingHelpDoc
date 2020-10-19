using System;
using System.Collections.Generic;

namespace WebApplication1.Models
{
    public partial class Countries
    {
        public Countries()
        {
            Cities = new HashSet<Cities>();
        }

        public long Id { get; set; }
        public long? Code { get; set; }
        public string Name { get; set; }
        public DateTime? CreatedAt { get; set; }
        public DateTime? UpdatedAt { get; set; }

        public virtual ICollection<Cities> Cities { get; set; }
    }
}
