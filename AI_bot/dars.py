import json, pickle, numpy, nltk
import random

from nltk.stem import WordNetLemmatizer
from tensorflow.python.keras.layers import Dropout, Dense
from tensorflow.python.keras.models import Sequential
from tensorflow.python.keras.optimizer_v2.gradient_descent import SGD

def training():
    lemmatizer = WordNetLemmatizer()
    intents = json.loads(open("datas/intents.json").read())
    # print(intents)
    # nltk.download()
    words = []
    classses = []
    docs = []
    ignore_list = ['?', '!', '.', ',', "'"]

    for intent in intents['intents']:
        for pattern in intent['patterns']:
            word_list = nltk.word_tokenize(pattern)
            words.extend(word_list)
            docs.append((word_list, intent['tag']))
            if intent['tag'] not in classses:
                classses.append(intent['tag'])

    words = [lemmatizer.lemmatize(word) for word in words if word not in ignore_list]
    words = sorted(set(words))
    classses = sorted(set(classses))
    # print(words)

    pickle.dump(words, open("datas/words.pkl", "wb"))
    pickle.dump(classses, open("datas/classses.pkl", "wb"))

    training = []
    out = [0] * len(classses)

    for doc in docs:
        bag = []
        word_patterns = doc[0]
        word_patterns = [lemmatizer.lemmatize(word.lower()) for word in word_patterns]
        for word in words:
            if word in word_patterns:
                bag.append(1)
            else:
                bag.append(0)

        out_row = list(out)
        out_row[classses.index((doc[1]))] = 1
        training.append([bag, out_row])

    random.shuffle(training)
    training = numpy.array(training)

    train_x = list(training[:, 0])
    train_y = list(training[:, 1])

    model = Sequential()
    model.add(Dense(128, input_shape=(len(train_x[0]),), activation='relu'))
    model.add(Dropout(0.5))
    model.add(Dense(64, activation='relu'))
    model.add(Dropout(0.5))

    model.add(Dense(len(train_y[0]), activation='softmax'))
    sgd = SGD(learning_rate=0.01, decay=1e-6, momentum=0.9, nesterov=True)
    model.compile(loss='categorical_crossentropy', optimizer=sgd, metrics=['accuracy'])

    hist = model.fit(numpy.array(train_x), numpy.array(train_y), epochs=200, batch_size=5, verbose=1)
    model.save('chatbot_model.h5', hist)
    print("o'rganish tugadi !")
