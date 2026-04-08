# -*- coding: utf-8 -*-
"""content_based_filtering.ipynb

Content-Based Filtering Recommendation System
Uses job/item features to recommend similar items to a user.
"""

# ─────────────────────────────────────────
# 1. Import Libraries
# ─────────────────────────────────────────
import pandas as pd
import numpy as np
import seaborn as sns
import matplotlib.pyplot as plt

from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

# ─────────────────────────────────────────
# 2. Mount Google Drive & Load Data
# ─────────────────────────────────────────
from google.colab import drive
drive.mount('/content/drive')

import os
os.chdir('/content/drive/MyDrive/contents/recommendation_system')

# Read in data
ratings = pd.read_csv('ml-latest-small/ratings.csv')
jobs    = pd.read_csv('ml-latest-small/jobs.csv')

print('Ratings shape:', ratings.shape)
print('Jobs shape   :', jobs.shape)

ratings.head()
jobs.head()

# ─────────────────────────────────────────
# 3. Explore the Data
# ─────────────────────────────────────────
print('Unique users  :', ratings.userId.nunique())
print('Unique jobs   :', ratings.jobId.nunique())
print('Unique ratings:', ratings.rating.nunique())
print('Rating values :', sorted(ratings.rating.unique()))

# ─────────────────────────────────────────
# 4. Prepare Job Features
# ─────────────────────────────────────────
# jobs.csv is expected to have columns: jobId, title, genres (or tags/description)
# Example row: 1, "Data Scientist", "Machine Learning|Python|Statistics"

# Fill missing genres/tags
jobs['genres'] = jobs['genres'].fillna('')

# Combine all text features into one string per job
# If you have more columns (e.g. skills, location) add them here:
# jobs['features'] = jobs['title'] + ' ' + jobs['genres'] + ' ' + jobs['skills']
jobs['features'] = jobs['title'] + ' ' + jobs['genres']

jobs[['jobId', 'title', 'genres', 'features']].head()

# ─────────────────────────────────────────
# 5. TF-IDF Vectorization
# ─────────────────────────────────────────
# Convert text features into numerical vectors
tfidf = TfidfVectorizer(stop_words='english')
tfidf_matrix = tfidf.fit_transform(jobs['features'])

print('TF-IDF matrix shape:', tfidf_matrix.shape)
# (number_of_jobs, number_of_unique_words)

# ─────────────────────────────────────────
# 6. Compute Job-Job Cosine Similarity
# ─────────────────────────────────────────
cosine_sim = cosine_similarity(tfidf_matrix, tfidf_matrix)
print('Cosine similarity matrix shape:', cosine_sim.shape)

# Map job titles to their index in the dataframe
job_indices = pd.Series(jobs.index, index=jobs['title']).drop_duplicates()

# ─────────────────────────────────────────
# 7. Content-Based Recommendation Function
# ─────────────────────────────────────────
def get_content_recommendations(job_title, top_n=10):
    """
    Given a job title, return the top_n most similar jobs
    based on content features (TF-IDF + cosine similarity).
    """
    if job_title not in job_indices:
        print(f'Job "{job_title}" not found in the dataset.')
        return pd.DataFrame()

    # Get the index of the job
    idx = job_indices[job_title]

    # Get similarity scores for all jobs vs this job
    sim_scores = list(enumerate(cosine_sim[idx]))

    # Sort by similarity score descending
    sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)

    # Remove the job itself (score = 1.0 with itself)
    sim_scores = [s for s in sim_scores if s[0] != idx]

    # Get top n
    sim_scores = sim_scores[:top_n]

    # Get job indices and scores
    job_idx    = [s[0] for s in sim_scores]
    job_scores = [s[1] for s in sim_scores]

    # Build result dataframe
    recommendations = jobs.iloc[job_idx][['jobId', 'title', 'genres']].copy()
    recommendations['similarity_score'] = job_scores
    recommendations.reset_index(drop=True, inplace=True)

    return recommendations


# ─────────────────────────────────────────
# 8. Get Recommendations for a Specific Job
# ─────────────────────────────────────────
# Change this to any job title in your dataset
sample_job = jobs['title'].iloc[0]
print(f'\nRecommendations similar to: "{sample_job}"\n')

recommendations = get_content_recommendations(sample_job, top_n=10)
print(recommendations)

# ─────────────────────────────────────────
# 9. Personalized Recommendations for a User
# ─────────────────────────────────────────
# Find jobs the user liked (rating >= 4), then recommend similar ones

picked_userId = 1

# Get jobs the user rated highly
user_ratings = ratings[ratings['userId'] == picked_userId]
liked_jobs   = user_ratings[user_ratings['rating'] >= 4.0].merge(jobs, on='jobId')

print(f'\nUser {picked_userId} liked these jobs:')
print(liked_jobs[['jobId', 'title', 'rating']])

# Collect all recommendations based on liked jobs
all_recommendations = pd.DataFrame()

for title in liked_jobs['title']:
    recs = get_content_recommendations(title, top_n=10)
    all_recommendations = pd.concat([all_recommendations, recs], ignore_index=True)

# Remove jobs the user has already rated
rated_job_ids = user_ratings['jobId'].values
all_recommendations = all_recommendations[~all_recommendations['jobId'].isin(rated_job_ids)]

# Average similarity score for duplicate recommendations
final_recommendations = (
    all_recommendations
    .groupby(['jobId', 'title', 'genres'], as_index=False)['similarity_score']
    .mean()
    .sort_values(by='similarity_score', ascending=False)
    .reset_index(drop=True)
)

# Top j recommendations
j = 10
print(f'\nTop {j} Content-Based Recommendations for User {picked_userId}:\n')
print(final_recommendations.head(j))

# ─────────────────────────────────────────
# 10. Visualization
# ─────────────────────────────────────────
top_recs = final_recommendations.head(j)

plt.figure(figsize=(10, 6))
sns.barplot(
    x='similarity_score',
    y='title',
    data=top_recs,
    palette='viridis'
)
plt.title(f'Top {j} Job Recommendations for User {picked_userId}')
plt.xlabel('Similarity Score')
plt.ylabel('Job Title')
plt.tight_layout()
plt.show()
