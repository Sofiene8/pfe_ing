use("jobsquare");

print("=== Structure complete offre Full Stack Junior ===");
printjson(db.listings.findOne({ _id: ObjectId("69f350cf8b6979bd3e5d7509") }));

print("\n=== Structure complete offre legacy _id=5002 ===");
printjson(db.listings.findOne({ _id: 5002 }));