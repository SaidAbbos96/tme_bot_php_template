const TelegramBot = require("node-telegram-bot-api")
const TOKEN = "5314942065:AAHOQV9K5KpVpvK4em1vEJVauaWjwh6WlWM"
const bot = new TelegramBot(TOKEN, { polling: true })
const MODERATOR = 679143250
bot.on('message', async message => {
    console.log(message)
    const text = message.text;
    const chatId = message.chat.id
    try {
        if (chatId == MODERATOR) {
            if (text === '/start') {
                return await bot.sendMessage(chatId, `Node.js dan salom, <b>Bot ishlayapti</b> !!!`, {
                    parse_mode: "HTML"
                })
            } else if (message.reply_to_message) {
                await bot.sendMessage(message.reply_to_message.forward_from.id, message.text, {
                    parse_mode: "HTML"
                })
            }
        } else {
            if (text === '/start') {
                let reply = `PHP 😎 Assalom alaykum <b>${message.from.first_name}</b>, <a href='https://www.youtube.com/c/infomiruz'>infomiruz chatboti</a>ga hush kelibsiz !!!\nMurojat Yo'llashingiz Mumkin 👇`
                await bot.sendMessage(chatId, reply, {
                    parse_mode: "HTML"
                });
                let date = new Date()
                reply = `Yangi mijoz:\n${message.from.first_name}\n👉 👉 <a href='tg://user?id=${message.from.id}'>${message.from.id}</a>\n${date.toString()}`
                await bot.sendMessage(MODERATOR, reply, {
                    parse_mode: "HTML"
                });
                await bot.forwardMessage(MODERATOR, chatId, message.message_id)
            }else{
                await bot.forwardMessage(MODERATOR, chatId, message.message_id)
            }
        }
    } catch (e) {
        return bot.sendMessage(MODERATOR, 'Xatolik !')
    }
})