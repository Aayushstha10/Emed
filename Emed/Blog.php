<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
            background-color: #2e7d32;
            color: white;
            padding: 15px 0;
            font-size: 24px;
        }
        #blog-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 30px;
            justify-items: center;
        }
        .blog-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
            margin-bottom: 30px;
        }
        .blog-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }
        .blog-card h2 {
            color: #1b5e20;
            margin-top: 10px;
        }
        .blog-card p {
            flex-grow: 1;
        }
        .read-more-container {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            height: 50px;
        }
        .blog-card a {
            display: inline-block;
            padding: 8px 12px;
            background: #1b5e20;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>

</head>
<body>
    <header>
        <h1>Medical Blog</h1>
    </header>
    
    <section id="blog-container">
        <!-- Blogs will be loaded here dynamically -->
    </section>
    
    <script>
        const blogs = [
            {title: "Heart Health Tips", url: "https://www.mayoclinic.org/healthy-lifestyle", description: "Learn how to keep your heart healthy with expert advice.", image: "Photos/heart.png"},
            {title: "Managing Diabetes", url: "https://www.cdc.gov/diabetes/managing", description: "Tips on managing diabetes and living a healthier life.", image: "Photos/diabetes.jpg"},
            {title: "Cancer Prevention", url: "https://www.cancer.org/cancer/cervical-cancer", description: "Early detection and prevention strategies for cancer.", image: "Photos/cancer.jpg"},
            {title: "Mental Health Awareness", url: "https://www.nimh.nih.gov/health/topics", description: "Understand mental health and ways to maintain a positive mindset.", image: "Photos/mental.jpg"},
            {title: "Healthy Diet Guide", url: "https://www.health.harvard.edu/nutrition", description: "Expert recommendations on balanced diets and nutrition.", image: "Photos/healthy.jpg"},
            {title: "COVID-19 Updates", url: "https://www.who.int/emergencies/diseases/novel-coronavirus-2019", description: "Latest updates and prevention tips for COVID-19.", image: "Photos/covid.jpg"},
            {title: "Weight Loss Strategies", url: "https://www.nhs.uk/live-well/healthy-weight", description: "Healthy ways to lose weight and maintain fitness.", image: "Photos/weight.jpg"},
            {title: "Child Vaccination Guide", url: "https://www.cdc.gov/vaccines/schedules", description: "Complete guide to vaccinations for children.", image: "Photos/children.jpg"},
            {title: "Chronic Pain Management", url: "https://www.hopkinsmedicine.org/health/conditions-and-diseases/chronic-pain", description: "Tips for managing chronic pain effectively.", image: "Photos/chronic.jpg"},
            {title: "Skin Care and Dermatology", url: "https://www.aad.org/public", description: "Expert advice on skincare and common skin issues.", image: "Photos/skin.jpg"},
            {title: "Sleep Hygiene Tips", url: "https://www.sleepfoundation.org/sleep-hygiene", description: "How to improve your sleep quality with good sleep habits.", image: "Photos/sleep.jpg"},
            {title: "Exercise and Fitness", url: "https://www.acefitness.org/education-and-resources/lifestyle/blog", description: "Best exercises to maintain overall fitness and health.", image: "Photos/work.jpg"}
        ];

        const container = document.getElementById("blog-container");

        blogs.forEach(blog => {
            let card = document.createElement("div");
            card.classList.add("blog-card");
            card.innerHTML = `
                <img src="${blog.image}" alt="${blog.title}">
                <h2>${blog.title}</h2>
                <p>${blog.description}</p>
                <div class="read-more-container">
                    <a href="${blog.url}" target="_blank">Read More</a>
                </div>
            `;
            container.appendChild(card);
        });
    </script>

</body>
</html>
