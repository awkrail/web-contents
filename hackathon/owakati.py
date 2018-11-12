import pickle
import requests
import MeCab
from bs4 import BeautifulSoup
import time

with open("title_url.pkl", "rb") as f:
  title_url = pickle.load(f)

base_url = "http://j-lyric.net"

for title, url in title_url.items():
  access_url = base_url + url
  response = requests.get(access_url)
  soup = BeautifulSoup(response.content, "lxml")
  lyrics_str = str(soup.find(id="Lyric"))
  lyricses = lyrics_str.replace('<p id="Lyric">', "").replace("</p>", "").split("<br/>")[:-1]
  
  """
  Mecabで分かち書きする
  """
  tagger = MeCab.Tagger("-Owakati")
  owakati_lyricses = []
  
  for lyrics in lyricses:
    owakati_lyricses.append(tagger.parse(lyrics))
        
  with open("bump_owakati.txt", "a") as f:
    for owakati_lyrics in owakati_lyricses:
      if owakati_lyrics == "\n":
        continue
      f.write(owakati_lyrics)
  
  time.sleep(2)
  print(title, ", done!")
