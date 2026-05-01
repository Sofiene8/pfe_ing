use("jobsquare");

print("=== Total listings ===");
print(db.listings.countDocuments());

print("\n=== Offres actives type job_offer (listing_type_sid=6) ===");
print(db.listings.countDocuments({ active: { $in: [1, true] }, listing_type_sid: 6 }));

print("\n=== Nouvelles offres avec created_at ===");
db.listings.find(
  { created_at: { $exists: true } },
  { title: 1, external_id: 1, created_at: 1, featured: 1, active: 1, listing_type_sid: 1 }
).limit(5).forEach(printjson);

print("\n=== Offre Full Stack Junior ===");
db.listings.find(
  { $or: [
    { external_id: { $regex: "full", $options: "i" } },
    { title: { $regex: "full", $options: "i" } },
    { Title: { $regex: "full", $options: "i" } }
  ]},
  { title: 1, Title: 1, external_id: 1, created_at: 1, date_add: 1, featured: 1, active: 1, listing_type_sid: 1 }
).forEach(printjson);

print("\n=== 5 offres les plus recentes (created_at) ===");
db.listings.find(
  { created_at: { $exists: true } }
).sort({ created_at: -1 }).limit(5).forEach(doc => {
  print(doc.external_id || doc.Title || doc.title, "| created_at:", doc.created_at, "| featured:", doc.featured, "| active:", doc.active, "| sid:", doc.listing_type_sid);
});