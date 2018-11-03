#coding:utf-8
from urllib.request import urlopen
import yaml
#import Parser
from collections import defaultdict
import random
import MeCab
import json
import requests

class Parser(object):
  def __init__(self):
    pass

  def parse(self,sentence):
    tagger = MeCab.Tagger('-Owakati')
    node = tagger.parse(sentence)
    return node

class ShosetsukaniNarou(object):
  def __init__(self):
    pass

  def getData(self,url):
    """
    yaml => jsonへ変更
    """
    response = requests.get(url)
    json_novel = json.loads(response.content.decode("utf-8"))
    documents = [data['story'] for data in json_novel[1:]]
    parser = Parser()
    split_words = [parser.parse(document).split(" ") for document in documents]
    return split_words

class MalkovChain(object):
  def __init__(self):
    self.dictionary = defaultdict(list)

  def fit(self,split_words,word_length=1):
    self.split_word_length = word_length
    for split_word in split_words:
      for i in range(len(split_word) - word_length):
        end_of_word_position = i+word_length
        dict_string = ""
        for word in split_word[i:end_of_word_position]:
          dict_string = dict_string + word
        self.dictionary[dict_string].append(split_word[end_of_word_position])

  def transform(self,word,limit=1):
    parser = Parser()
    #import ipdb; ipdb.set_trace()
    word_list = parser.parse(word).split(" ")[:-1] #最後のindexは改行コードの削除必
    if self.split_word_length != len(word_list):
      print("情報が欠如しています。")
      return ""
    end_cnt = 0
    cnt = 0

    while limit != end_cnt:
      stract_words = word_list[cnt:cnt+self.split_word_length]
      temp_word = ""
      for stract_word in stract_words:
        temp_word = temp_word + stract_word

      word = random.choice(self.dictionary[temp_word])
      word_list.append(word)

      if "。" in word:
        end_cnt = end_cnt + 1
      cnt = cnt + 1
    sentence = ""
    for i in range(len(word_list)):
      sentence = sentence + word_list[i]
    return sentence

data = ShosetsukaniNarou()
split_words = data.getData("http://api.syosetu.com/novelapi/api/?genre=1&lim=100&out=json")
MalkovChain = MalkovChain()
MalkovChain.fit(split_words,word_length=2) #ワードを分割する長さを入れる
for i in range(5):
  print(MalkovChain.transform("日常と", 1)) #ここに単語を入れる