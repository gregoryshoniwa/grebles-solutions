# Grebles Solutions — Service Delivery Playbook (Internal)

> Internal document. How we scope, price, deliver, and support every offering.
> Companion to [BUSINESS_PLAN.md](BUSINESS_PLAN.md). Last updated: 2026-06-12

---

## 1. Deployment & Hosting Models

Every offering is sold under one of three deployment models. Decide this at the proposal stage — it changes pricing, responsibilities, and margins.

### Model A — Grebles-Hosted (Managed) — *default, push this*

We host everything on our infrastructure (multi-tenant Laravel platform, n8n, LiveKit, knowledge base). Client pays setup + monthly subscription. We own uptime, updates, backups, and API keys.

- **Best for:** SMEs with no IT staff (most clients).
- **Margin profile:** highest recurring margin; infra cost shared across tenants.
- **Pricing:** standard price-list rates (see §3).

### Model B — Client Self-Hosted (Their Cloud/VPS)

We deploy onto the client's own cloud account or VPS. Client pays their own infrastructure and AI/API usage directly; we charge a deployment fee + a reduced support retainer.

- **Best for:** Clients with data-residency preferences or existing cloud spend; technically capable clients.
- **Pricing:** deployment fee = 1.5× the Model A setup fee (more environment work, less repeatability). Support retainer = 50–70% of the Model A subscription.
- **Rules:** client signs a responsibilities matrix (we are not on-call for their infra outages); minimum environment spec documented before we commit; access via their IAM, never shared root credentials.

### Model C — On-Premises

Installed on servers at the client's site. Reserved for corporates, NGOs, banks, and government — sell with a governance engagement attached.

- **Pricing:** setup = 2–3× Model A setup + site work billed per day; mandatory annual support contract at 20–25% of total project value; updates delivered on a scheduled cadence (not continuous).
- **Pre-sale checklist:** server spec & UPS/generator power confirmed; network/firewall rules agreed; named client IT contact; remote-access path for support agreed in writing.
- **Caution:** never sell Model C to a client without IT staff. Voice/video agents on-prem still require outbound internet for model APIs — set that expectation in the contract.

### Responsibilities Matrix (include in every contract)

| Responsibility | Model A | Model B | Model C |
| -------------- | ------- | ------- | ------- |
| Infrastructure & uptime | Grebles | Client | Client |
| App deployment & updates | Grebles | Grebles (scheduled) | Grebles (scheduled) |
| AI/API accounts & costs | Grebles (metered into subscription) | Client | Client |
| Backups | Grebles | Client (we configure) | Client (we configure) |
| Knowledge base content updates | Client submits, agent ingests | Same | Same |
| Support (tier 1) | Grebles AI agents | Grebles AI agents | Grebles AI agents |
| Security patching | Grebles | Shared | Shared |

---

## 2. Cost Model — Know Your Numbers Before Quoting

### Recurring cost inputs (per client, Model A)

| Cost item | Driver | Estimating rule |
| --------- | ------ | --------------- |
| LLM API (chat agent) | messages × tokens | Estimate from client's current monthly WhatsApp/enquiry volume; route simple turns to a cheap model, escalate hard ones |
| Gemini Live (voice/video) | minutes | Realtime audio/video is billed per minute-equivalent — the dominant cost for voice/video tiers; always cap minutes per plan |
| Telephony / SIP | minutes + number rental | Local number rental + per-minute rates from provider |
| WhatsApp Business API | per-conversation fees | Meta bills per 24h conversation window; estimate from volume |
| Avatar rendering | video minutes | Most expensive single input; only in video tier, hard-capped |
| Hosting (shared) | per-tenant slice | VPS/cloud cost ÷ active tenants |
| n8n | self-hosted | Near-zero marginal cost — this is why automation retainers are high-margin |

### Pricing rules

1. **Gross margin floor: 70%** on every subscription. If estimated infra cost exceeds 30% of the monthly price, raise the price or lower the caps — never quote first and check later.
2. **Every plan has hard usage caps** (messages/mo, voice minutes/mo, video minutes/mo). Overage billed per unit or auto-upgrade to next tier.
3. **Setup fees are never waived** — they cover real build hours and qualify serious buyers. Discount the first months of subscription instead if needed.
4. **Founder hour rate for project work:** target $40–60/hr effective (Zimbabwe market) and $75–120/hr (regional/remote) — quote fixed-price externally, sanity-check internally against estimated hours × rate.
5. **Annual prepay = 10% discount, 12-month minimum on subscriptions** for cash flow.
6. **Pass-through clause in every contract:** if a vendor (Meta, Google, telephony) raises prices >15%, we may adjust the subscription with 30 days' notice.

### Example internal costing (AI Customer Agent, Zimbabwe Standard tier)

| | |
|---|---|
| Price | $150/mo, 1,500 conversations cap |
| LLM cost @ volume | ~$15–25 |
| WhatsApp conversation fees | ~$10–20 |
| Hosting slice | ~$5 |
| **Infra total** | **~$30–50 (20–33%)** ✅ at the floor — watch volume |

---

## 3. Offer Catalogue & Costing

### 3.1 Website Essentials (small-business entry product) ⭐ volume driver

For small companies that just want a new website, or a refresh of an old one — with an AI agent added. This is the **front door of the funnel**: cheapest to deliver (templated), easiest to sell, and every site ships with our chat widget as a built-in upsell.

**Two ways to buy:**

**(a) Project + Care Plan**

| Tier | What's included | Zimbabwe | Regional |
| ---- | --------------- | -------- | -------- |
| Refresh | Redesign/rebuild existing site, up to 5 pages, mobile-ready, contact forms, SEO basics | $250–$500 | $800–$1,500 |
| New Site | New 5–8 page site, copy assistance, analytics, booking/enquiry forms | $400–$900 | $1,200–$2,500 |
| Site + AI Agent | Either of the above + web chat agent with Company Knowledge Base (FAQs, services, prices) | +$150–$300 setup | +$400–$800 setup |
| Care Plan (required for hosting) | Hosting, SSL, backups, updates, small content edits | $25–$50/mo | $60–$120/mo |
| AI Agent subscription | Agent usage, knowledge base updates, monthly Q&A report | +$30–$80/mo | +$80–$200/mo |

**(b) Website-as-a-Service (zero/low upfront)** — for cash-tight small businesses:

| Plan | Upfront | Monthly (12-mo minimum) | Includes |
| ---- | ------- | ----------------------- | -------- |
| WaaS Basic | $0–$100 | $50–$80 (Zim) / $120–$200 (regional) | New site + hosting + care |
| WaaS + Agent | $0–$150 | $80–$130 (Zim) / $200–$350 (regional) | Site + web chat agent + knowledge base |
| WaaS + Agent + WhatsApp | $100–$200 | $120–$180 (Zim) / $300–$500 (regional) | Adds WhatsApp channel to the agent |

WaaS rules: 12-month minimum contract; we own the build until month 12 (then ownership transfers); non-payment = site suspension (automated); price includes one design refresh per 24 months. Build from a small set of reusable Laravel/Vue or static templates — **target ≤2 days founder time per WaaS site**.

### 3.2 AI Customer Agent (chat)

| Tier | Channels | Cap | Zimbabwe | Regional |
| ---- | -------- | --- | -------- | -------- |
| Starter | Web widget | 500 conv/mo | $300 setup + $80/mo | $1,000 setup + $250/mo |
| Standard | + WhatsApp | 1,500 conv/mo | $500 setup + $150/mo | $1,500 setup + $400/mo |
| Pro | + FB/IG, integrations (booking, CRM) | 4,000 conv/mo | $800 setup + $250/mo | $2,500 setup + $600/mo |

Setup includes: knowledge base build from client documents, tone/persona config, escalation rules, testing, go-live.

### 3.3 AI Voice Receptionist

| Tier | Cap | Zimbabwe | Regional |
| ---- | --- | -------- | -------- |
| Standard | 300 min/mo, 1 line, bookings + messages | $700 setup + $180/mo | $1,800 setup + $450/mo |
| Pro | 800 min/mo, transfers, CRM logging, after-hours overflow mode | $1,200 setup + $350/mo | $3,000 setup + $800/mo |

Overage per minute billed. "After-hours overflow only" is a cheap entry config — sell it to clients nervous about full AI reception.

### 3.4 AI Video Agent / Avatar

| Tier | Cap | Zimbabwe | Regional |
| ---- | --- | -------- | -------- |
| Video Agent | 200 video min/mo, screen-share guidance, branded avatar | $1,500 setup + $350/mo | $3,500 setup + $900/mo |
| Video Agent Pro | 500 min/mo, custom avatar likeness, sales demo flows | $2,500 setup + $600/mo | $6,000 setup + $1,500/mo |

Sell to SA/urban clients first (bandwidth). Always bundled with chat fallback.

### 3.5 Process Automation (n8n)

| Package | Scope | Zimbabwe | Regional |
| ------- | ----- | -------- | -------- |
| Starter Pack | 1–2 workflows | $400–$1,200 | $1,000–$3,500 |
| Growth System | 3–6 workflows + dashboard | $1,500–$4,000 | $4,000–$12,000 |
| Ops Overhaul | 6–15 workflows, multi-system | $4,000–$10,000 | $12,000–$35,000 |
| Automation Care | monitoring, fixes, 1 change/mo | $50–$150/mo | $200–$500/mo |

Internally: estimate hours per workflow (simple: 2–4h, with integrations: 6–12h), price at fixed-fee ≥ hours × rate × 1.4 contingency.

### 3.6 Custom Development / Integration / Governance

Scoped per engagement against the founder hour rate (§2.4). Governance engagements follow the COBIT assessment workflow (§4.7). Always attach a care retainer to anything we build.

---

## 4. Implementation Workflows

### 4.0 New Customer Signup — Master Workflow (all products)

Standard pipeline; per-product steps slot into Phase 3. Owners: 🤖 = AI agent/automation, 👤 = founder.

| Phase | Steps | Owner | Target time |
| ----- | ----- | ----- | ----------- |
| 1. Lead | Enquiry arrives (WhatsApp/web/call) → agent qualifies (industry, size, need, budget band) → books discovery call | 🤖 | same day |
| 2. Discovery & Proposal | Discovery call (template §5.1) → proposal generated from template (§5.2), founder reviews → e-sign + invoice for setup fee/deposit | 👤 call, 🤖 paperwork | 48h from call |
| 3. Onboarding | Payment confirmed → client portal account auto-created → onboarding form sent (§5.3) → client uploads documents/brand assets → kickoff message with timeline | 🤖 | starts on payment |
| 4. Build | Product-specific build (see below) → internal QA checklist | 👤 + 🤖 | per product SLA |
| 5. UAT | Client tests against UAT checklist (§5.4) → feedback round (1 included) → sign-off in portal | client + 🤖 chase | 3–5 days |
| 6. Go-Live | Deploy/connect channels → smoke test → go-live checklist (§5.5) → handover doc + training video | 👤 + 🤖 | 1 day |
| 7. Care | Subscription billing starts at go-live → weekly health checks → monthly report (§5.6) auto-sent → 30-day review call → quarterly upsell review | 🤖, 👤 reviews | ongoing |

**Hard rules:** no build starts before setup fee clears; UAT feedback beyond 1 round or scope additions = change order (quoted, signed); subscription starts at go-live or 21 days after build completion if client delays UAT (whichever first — prevents free parking).

### 4.1 Website Essentials / WaaS

1. Onboarding form: business profile, services, brand assets, domain access, content sources. 🤖
2. Template selection + copy draft generated from the form; founder curates. 👤 0.5 day
3. Build from template, mobile + speed pass. 👤 ≤1 day
4. If AI agent included: knowledge base built from site content + uploaded docs (§4.2 steps 2–4).
5. UAT link → one feedback round → DNS cutover (or subdomain first), SSL, analytics. 👤 0.5 day
6. Go-live + handover video. Care/WaaS billing starts.

**SLA: 7–10 working days. Founder time budget: ≤2 days.**

### 4.2 AI Customer Agent (chat)

1. Knowledge intake: client uploads price lists, FAQs, policies, brochures via portal; agent flags gaps (missing prices, contradictions) for client to resolve. 🤖
2. Build Company Knowledge Base: ingest → chunk → embed → test retrieval against 30 seeded questions. 🤖 build, 👤 review
3. Persona & guardrails: tone, languages (English + Shona/Ndebele as needed), escalation triggers, forbidden topics, handoff number/email. 👤 1–2h
4. Channel connect: web widget / WhatsApp Business API / FB-IG. 👤 + 🤖
5. Test pass: 50-question scripted test + 3 days shadow mode (agent drafts, human approves) for nervous clients. 🤖
6. UAT with client (they ask their own questions) → tune → go-live.
7. Care: weekly unanswered-questions report feeds knowledge base updates. 🤖

**SLA: 5–10 working days. Founder time budget: ≤1 day.**

### 4.3 AI Voice Receptionist

1. Number strategy: new local number or forward existing line (after-hours overflow vs full reception). 👤
2. Knowledge base as §4.2 + call-specific flows: greeting script, booking calendar connect, message-taking format, transfer rules. 👤 0.5 day
3. LiveKit SIP + Gemini Live pipeline config from the standard template; voice selection with client. 🤖 + 👤
4. Test calls: 20 scripted scenarios (booking, price query, angry caller, wrong number, transfer). 👤 + 🤖
5. Soft launch: after-hours only for week 1 → review transcripts → full launch. 
6. Care: monthly call-quality sample review, minutes-usage alerts at 80% of cap. 🤖

**SLA: 10–15 working days. Founder time budget: ≤2 days.**

### 4.4 AI Video Agent / Avatar

1. Avatar selection: stock avatar (fast) or custom likeness (Pro tier, +consent form). 👤
2. Build on top of an existing chat/voice agent's knowledge base (require §4.2 first — never sell video standalone).
3. LiveKit room flow embedded in client's site/portal; screen-share guidance scripts for their key processes (e.g. "walk customer through the application form"). 👤 1–2 days
4. Bandwidth test from client's typical customer profile; configure voice/chat fallback.
5. Pilot with 5 real customer sessions, review recordings with client → go-live.

**SLA: 15–20 working days. Founder time budget: ≤3 days.**

### 4.5 Process Automation (n8n)

1. Process discovery workshop: map the manual process end-to-end, identify systems, volumes, exceptions. 👤 2–4h (billable inside setup)
2. Workflow spec one-pager per automation: trigger → steps → systems → failure handling → human checkpoint. Client signs the spec. 👤
3. Build in client's n8n workspace (Model A: our server, white-labelled; Model B/C: their instance). 👤 + 🤖
4. Parallel run: automation runs alongside the manual process for 1–2 weeks; compare outputs. 
5. Cutover + alerting (failures notify us and client) + runbook.
6. Care: monitoring, monthly run-stats in client report, 1 change/mo included.

**SLA: 5 days per simple workflow; spec-driven for systems.**

### 4.6 Custom Dev / Integration

Standard software project flow: requirements doc → fixed-price quote (hours × rate × 1.4) → milestone billing (40/40/20) → staging UAT → production + care retainer. Never start without the 40% deposit.

### 4.7 Governance Advisory (COBIT)

1. Scoping call: drivers (audit finding? AI adoption? compliance requirement?), org size, systems. 👤
2. Document request list + stakeholder interviews (can be conducted by AI agent via structured calls/forms for junior staff, founder interviews leadership). 🤖 + 👤
3. Assessment against selected COBIT objectives → gap report with prioritised roadmap. 👤 (template-driven)
4. Findings presentation + roadmap workshop.
5. Upsell: implementation of quick wins (often = our automation/dev products), annual reassessment retainer.

**SLA: 2–4 weeks per assessment.**

---

## 5. Templates

### 5.1 Discovery Call Script (30 min)

1. **Business:** What does the business do? Who are your customers? How do they reach you today?
2. **Pain:** Where do you lose time or sales? (missed calls? slow WhatsApp replies? manual quotes/invoices?) What happens after hours?
3. **Volumes:** Enquiries per day/week per channel? Calls per day? Staff handling them?
4. **Systems:** Website status? Accounting/CRM/booking tools? Who manages IT today?
5. **Money:** What is one lost customer worth? Budget comfort band (name the tiers).
6. **Deployment:** Any data-residency/on-prem requirements? (defaults to Model A)
7. **Close:** Agree next step + date proposal will arrive (within 48h).

### 5.2 Proposal Skeleton

1. Your situation (their words, from discovery)
2. What we'll deliver (tier + exact inclusions + caps)
3. What it replaces/saves (quantified from their volumes)
4. Timeline (from SLA tables)
5. Investment: setup + monthly, deployment model, what's NOT included
6. Terms: deposit, UAT rounds, change orders, contract minimum, pass-through clause
7. Next step: e-sign link + invoice

### 5.3 Onboarding Form (per product — auto-sent from portal)

Common: legal name, trading name, logo/brand colours, contact persons, billing details, domain/DNS access (websites), social/WhatsApp admin access (agents).
Agent products: services & price list, FAQs, policies (refunds, delivery, hours), tone preference (formal/friendly), languages, escalation contact, forbidden topics, top 20 real customer questions.
Automation: systems list + credentials path (never email passwords — portal vault), process owner contact, current process documents.

### 5.4 UAT Checklist (client-facing)

- [ ] Ask the agent your 10 hardest real customer questions — answers correct?
- [ ] Test escalation: ask something it shouldn't answer — does it hand off properly?
- [ ] Check prices/hours/contact details it quotes — all current?
- [ ] (Voice) Call and book an appointment end-to-end
- [ ] (Web) View site on phone, tablet, desktop; submit every form
- [ ] (Automation) Verify parallel-run outputs match your manual process
- [ ] Confirm branding, tone, and languages feel right
- [ ] Sign off in portal (starts go-live)

### 5.5 Go-Live Checklist (internal)

- [ ] Production channels connected & verified (send/receive test on each)
- [ ] Usage caps + overage alerts configured (80% warning)
- [ ] Monitoring + failure alerts wired to ops channel
- [ ] Backups confirmed (and tested restore for Model B/C)
- [ ] Billing subscription activated; invoice schedule verified
- [ ] Handover doc + training video delivered
- [ ] 30-day review call booked
- [ ] Case-study consent requested (discount hook)

### 5.6 Monthly Client Report (auto-generated)

Conversations/calls handled · after-hours share · leads captured · top 10 questions · unanswered questions (→ knowledge base updates made) · usage vs cap · uptime · next month's suggestion (upsell slot).

---

## 6. Funnel & Upsell Map

```
Website Essentials / WaaS  ──►  + AI Chat Agent  ──►  + WhatsApp channel
        │                              │                      │
        ▼                              ▼                      ▼
   Care Plan (recurring)      + Voice Receptionist    + Automation Pack
                                       │                      │
                                       ▼                      ▼
                              + Video/Avatar Agent ──► "AI-Run Business"
                                                       transformation
                                                              │
                                                              ▼
                                                   Governance Advisory
                                                   (also a corporate entry point)
```

Every product's monthly report contains exactly one upsell suggestion. The 30-day and quarterly review calls are where upgrades are closed.
