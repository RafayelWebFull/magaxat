const getCountries = async () => {
    const response = await axios.get(
        "https://www.universal-tutorial.com/api/countries/",
        {
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                Authorization:
                    "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiJhbmFnb21sYTk0QGdtYWlsLmNvbSIsImFwaV90b2tlbiI6IkxnX0xJNUNOQ1VXd3BVRGxQOHZQazltX2h2ay1Sb3lLX2ZNWTNvcFhaOGlsR2swMVJIZzRuWHl5R1V4TWdiQUw1b2cifSwiZXhwIjoxNjQ4NzE1NzQxfQ.lmU3vlstqjY4_uPkK12Em330W1lx4zIatwsoybwhb30",
            },
        }
    );
};
