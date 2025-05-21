#!/bin/bash

echo "Downloading assets for Akstruct Construction website..."

# Hero images
echo "Downloading hero images..."
curl -L "https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=1920" --output public/assets/img/hero/project1.jpg
curl -L "https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=1920" --output public/assets/img/hero/project2.jpg
curl -L "https://images.unsplash.com/photo-1565352664505-53ca764d6bc7?q=80&w=1920" --output public/assets/img/hero/project3.jpg

# Services images
echo "Downloading service images..."
curl -L "https://images.unsplash.com/photo-1598257006458-087169a1f08d?q=80&w=1080" --output public/assets/img/services/services-main.jpg
curl -L "https://images.unsplash.com/photo-1581094271901-8022df4466f9?q=80&w=1080" --output public/assets/img/services/service-1.jpg
curl -L "https://images.unsplash.com/photo-1574362848149-11496d93a7c7?q=80&w=1080" --output public/assets/img/services/service-2.jpg
curl -L "https://images.unsplash.com/photo-1600661653561-629509216228?q=80&w=1080" --output public/assets/img/services/service-3.jpg
curl -L "https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?q=80&w=1080" --output public/assets/img/services/service-4.jpg

# Projects images
echo "Downloading project images..."
curl -L "https://images.unsplash.com/photo-1577962146048-5222efd56f45?q=80&w=1080" --output public/assets/img/projects/project1.jpg
curl -L "https://images.unsplash.com/photo-1608231261521-56f38852e850?q=80&w=1080" --output public/assets/img/projects/project2.jpg
curl -L "https://images.unsplash.com/photo-1541855394406-74e8552f2209?q=80&w=1080" --output public/assets/img/projects/project3.jpg
curl -L "https://images.unsplash.com/photo-1560748526-881709a28361?q=80&w=1080" --output public/assets/img/projects/project-preview.jpg
curl -L "https://images.unsplash.com/photo-1570843902501-36f231e7ad4a?q=80&w=1080" --output public/assets/img/projects/nigeria-map.jpg

# Team member images
echo "Downloading team member images..."
curl -L "https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=800" --output public/assets/img/team/team1.jpg
curl -L "https://images.unsplash.com/photo-1568602471122-7832951cc4c5?q=80&w=800" --output public/assets/img/team/team2.jpg
curl -L "https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=800" --output public/assets/img/team/team3.jpg

# Client images
echo "Downloading client images..."
curl -L "https://img.icons8.com/color/96/null/person-male.png" --output public/assets/img/clients/client1.png
curl -L "https://img.icons8.com/color/96/null/person-female.png" --output public/assets/img/clients/client2.png

# Create placeholder client logos
echo "Creating placeholder client logos..."
for i in {1..6}; do
  curl -L "https://placehold.co/200x100/1e3a54/ffffff?text=Client+$i" --output public/assets/img/clients/logo$i.png
done

curl -L "https://placehold.co/200x50/1e3a54/ffffff?text=GlobalTech" --output public/assets/img/clients/globaltech.png
curl -L "https://placehold.co/200x50/1e3a54/ffffff?text=EcoHomes" --output public/assets/img/clients/ecohomes.png

# Download sample videos
echo "Downloading sample videos..."
curl -L "https://download.samplelib.com/mp4/sample-5s.mp4" --output public/assets/video/construction-background.mp4
curl -L "https://download.samplelib.com/mp4/sample-10s.mp4" --output public/assets/video/project-preview.mp4

echo "Asset download complete!" 