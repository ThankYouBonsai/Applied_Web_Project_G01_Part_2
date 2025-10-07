<!--
    - At least 2 position descriptions using semantic HTML.
    - Must include: reference number (5 alphanumeric), title, short description, 
      salary, reporting line, key responsibilities, essential & preferable 
      requirements.
    - Use headings of at least 2 levels, multiple <section>, one <aside>, 
      one ordered list, one unordered list.
    - Content should be concise, realistic, and tailored to the chosen industry.

    - <aside> styled at 25% width, floated right, with border, margin, padding.
-->

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">

        <!-- Responsive Web Design -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- HTML Page Description for SEO -->
        <meta name="description" content="">

        <!-- Keywords for SEO -->
        <meta name="keywords" content="">

        <!-- Author Information -->
        <meta name="author" content="Jonah, James, Kia and Duc">

        <!-- Link to external CSS File -->
        <link rel="stylesheet" href="styles/stylessheet.css">

        <!-- Title of Web Page-->
        <title>MELONBALL | Jobs Availability</title>

        <style>
          .job_desc {color: rgb(56, 56, 56);}  
          aside {color: white;}
        </style>
    </head>
    <body>
        <!-- php Header with navigation menu-->
        <?php include 'header.inc'; ?>
        <main>
          <!-- main site area -->
          <div class="jobs_container">
            <aside> <!-- Ai generated aside details -->
              <h2>Gaming for Everyone</h2>
              <p>At MelonBall, we believe gaming is for everyone. 
                It's a place to connect, create, and find joy, no matter who you are or where you come from. 
                We&apos;re committed to building a community and creating games where every player feels seen, heard, and valued.
              </p>
              <p>Our goal is simple: to make a home for every kind of gamer. 
                We actively listen to our community, celebrate diversity, and work to ensure our games are approachable and welcoming to everyone. 
                We want you to feel included from the moment you join us.
              </p>
            </aside> <!--  All titles and descriptions are AI generated -->
            <div class="jobs_selection">
              <a class="apply_link" href="apply.php"><div class="jobs">
                <h1 class="job_title" style="color: rgb(201, 38, 74)"><strong>Environmental Designer</strong></h1> <!-- Job 1 -->
                <div class="job_meta">
                  <p>Reference: MBZHJ</p>
                  <p>Location: Remote or On-site (Hybrid Options Available)</p>
                  <p>Time: Casual</p>
                  <p>Salary: $70,000 - $90,000 USD / year (DOE)</p>
                </div>
                <div class="job_desc">
                  <p>MelonBall is seeking a talented and imaginative Environmental Designer to help shape the lush, immersive worlds at the heart of our tropical-inspired games. You’ll craft serene and visually striking environments that invite exploration and relaxation, blending stylized artistry with technical design.</p>
                </div>
                <div class="job_info">
                  <p>About the role: <br> MelonBall is seeking a talented and imaginative Environmental Designer to help 
                    shape the lush, immersive worlds at the heart of our tropical-inspired games. 
                    You&apos;ll craft serene and visually striking environments that invite exploration 
                    and relaxation, blending stylized artistry with technical design.
                  </p>
                  <p><strong>Essential Requirements:</strong></p>
                  <ul>
                    <li>3+ years of professional experience in 3D environmental design for games</li>
                    <li>Strong portfolio showcasing stylized or naturalistic 3D environments</li>
                    <li>Proficiency in Unreal Engine (particularly World Building tools and Level Streaming)</li>
                    <li>Excellent understanding of composition, scale, lighting, and color theory</li>
                    <li>Ability to work independently and collaboratively in a fast-paced, creative environment</li>
                  </ul>
                  <p><strong>Key Responsibilities:</strong></p>
                  <ul>
                    <li>Design and build immersive outdoor and indoor environments using Unreal Engine</li>
                    <li>Create level layouts that balance beauty, gameplay flow, and storytelling</li>
                    <li>Translate 2D concepts into compelling 3D scenes with strong composition and atmosphere</li>
                    <li>Collaborate with lighting, animation, and VFX teams to achieve cohesive world design</li>
                    <li>Optimize environments for performance and visual fidelity across platforms</li>
                    <li>Contribute to environmental storytelling and the overall player journey</li>
                    <li>Participate in playtests and iterate on feedback to refine world design</li>
                  </ul>
                </div>
              </div></a>
              <a class="apply_link" href="apply.php"><div class="jobs">
                <h1 class="job_title" style="color: rgb(201, 38, 74)"><strong>Unreal Engine & C++ Programmer</strong></h1> <!-- Job 2-->
                <div class="job_meta">
                  <p>Reference: MBDEVT</p>
                  <p>Location: Remote or On-site (Hybrid Options Available)</p>
                  <p>Time: Casual</p>
                  <p>Salary: $85,000 - $110,000 USD / year (DOE)</p>
                </div>
                <div class="job_desc">
                  <p>MelonBall is looking for a skilled Unreal Engine & C++ Programmer to help bring our peaceful, tropical game worlds to life. You’ll build responsive, elegant systems and gameplay mechanics that feel smooth, intuitive, and deeply immersive.</p>
                </div>
                <div class="job_info">
                  <p>About the role: <br> MelonBall is seeking a talented and imaginative Environmental Designer to help 
                    shape the lush, immersive worlds at the heart of our tropical-inspired games. 
                    You&apos;ll craft serene and visually striking environments that invite exploration 
                    and relaxation, blending stylized artistry with technical design.
                  </p>
                  <p><strong>Essential Requirements:</strong></p>
                  <ul>
                    <li>3+ years of experience with Unreal Engine and C++ in game development</li>
                    <li>Implement mechanics related to exploration, interaction, and world simulation</li>
                    <li>Experience developing and optimizing gameplay systems</li>
                    <li>Familiarity with Blueprints and how to bridge them with C++ code</li>
                    <li>Ability to write clean, modular, and well-documented code</li>
                  </ul>
                  <p><strong>Key Responsibilities:</strong></p>
                  <ul>
                    <li>Develop and maintain gameplay systems in Unreal Engine using C++</li>
                    <li>Create level layouts that balance beauty, gameplay flow, and storytelling</li>
                    <li>Optimize game code for performance across PC, console, and mobile platforms</li>
                    <li>Work closely with designers to prototype and refine new features</li>
                    <li>Debug and resolve issues across the codebase</li>
                    <li>Assist in integrating art and animation assets into the engine</li>
                    <li>Contribute to internal documentation and development tools</li>
                  </ul>
                </div>
              </div></a>
            </div>
          </div>
          <!-- End of main site area -->
        </main>
        <!-- php Footer with links to Discord, Jira and email-->
        <?php include 'footer.inc'; ?>
    </body>
</html>