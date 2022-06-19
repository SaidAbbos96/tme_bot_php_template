import json, random, numpy, pickle
import nltk
from nltk.stem import WordNetLemmatizer
from tensorflow.python.keras.models import load_model

from dars import training

lemmatizer = WordNetLemmatizer()
intents = json.loads(open("datas/intents.json").read())

words = pickle.load(open("datas/words.pkl",'rb'))
classses = pickle.load(open("datas/classses.pkl",'rb'))
model = load_model("chatbot_model.h5")

def clean_up_sentence(sentence):
    sen_words = nltk.word_tokenize(sentence)
    sen_words = [lemmatizer.lemmatize(word) for word in sen_words]
    return sen_words

def bag_words(sesntence):
    sen_words = clean_up_sentence(sesntence)
    bag = [0] * len(words)
    for w in sen_words:
        for i, word in enumerate(words):
            if word == w:
                bag[i] = 1
    return numpy.array(bag)

def pre_class(sentence):
    bow = bag_words(sentence)
    res = model.predict(numpy.array([bow]))[0]
    ERROR_THRESHOLD = 0.25
    results = [[i, r] for i, r in enumerate(res) if r > ERROR_THRESHOLD]
    results.sort(key=lambda x: x[1], reverse=True)
    return_list = []
    for r in results:
        return_list.append({'intent': classses[r[0]], 'probability': str(r[1])})
    return return_list

def get_answer(intents_list, intents_json):
    tag = intents_list[0]['intent']
    for i in intents_json['intents']:
        if i['tag'] == tag:
            return random.choice(i['responses'])

def chat_anwser(message):
    ints = pre_class(message)
    return get_answer(ints, intents)


def main_chat():
    print("Suhbatni boshlang: ")
    while True:
        message = input(">> ")
        if message == "stopchat":
            break
        ints = pre_class(message)
        res = get_answer(ints, intents)
        print(res)


if __name__ == '__main__':
    training()
    # main_chat()
